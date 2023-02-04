var BuildingMain = {
    BUILD_ERROR_REQ: 1,
    BUILD_ERROR_POP: 2,
    BUILD_ERROR_QUEUE: 3,
    BUILD_ERROR_RES: 4,
    BUILD_ERROR_QUEUE_RES: 5,
    upgrade_building_link: "",
    downgrade_building_link: "",
    link_reduce_buildtime: "",
    link_cancel: "",
    confirm_queue: !1,
    mode: 0,
    request_id: 0,
    last_request_id: 0,
    buildings: null,
    order_count: 0,
    is_buildability_initialized: !1,
    web_push: null,
    res_schedule: { time_generated: 0, rates: null, amounts: null },
    init: function () {
        require(["Ig/TribalWars/Modules/UI/WebPushWorld"], function (i) {
            BuildingMain.web_push = new i();
        }),
            BuildingMain.init_buildbuttons(),
            this.is_buildability_initialized ||
                ($(window.TribalWars).on("global_tick", function () {
                    setTimeout(BuildingMain.updateBuildableState, 1);
                }),
                Connection.registerObserver("building_main", BuildingMain.Synchronizer),
                (this.is_buildability_initialized = !0)),
            OrderProgress.initProgress(),
            BuildFeatureAvailability.init(),
            Connection.enqueueHandler("quest_data", function (i) {
                for (var e in i) {
                    var n = i[e],
                        a = n.goals.buildings;
                    a &&
                        a.forEach(function (i) {
                            var e = $(s('[data-building="%1"][data-level-next]', i.building));
                            if (e.data("level-next") <= i.level) {
                                e.addClass("current-quest").addClass("tooltip");
                                var a = e.prop("title");
                                (a = [a, n.title]
                                    .filter(function (i) {
                                        return i;
                                    })
                                    .join("<br /><br />")),
                                    e.prop("title", a),
                                    UI.ToolTip(e);
                            }
                        });
                }
            });
    },
    init_res_schedule: function (i, e, n) {
        (this.res_schedule.time_generated = i), (this.res_schedule.rates = ResourcesForecaster.Factory.createResourcesSchedule(e)), (this.res_schedule.amounts = ResourcesForecaster.Factory.createResourcesInVillageSchedule(n));
    },
    updateBuildableState: function () {
        if (BuildingMain.buildings) {
            var i = 0 == $("#buildqueue_wrap").length ? 0 : BuildingMain.order_count;
            BuildingMain.colorAffordability();
            var e = new Resources(game_data.village.wood, game_data.village.stone, game_data.village.iron);
            $.each(BuildingMain.buildings, function (n, a) {
                var l = $("#main_buildrow_" + n).find(".build_options");
                parseInt(l.data.error), l.data("could-afford");
                if (l) {
                    var u,
                        t,
                        d = new Resources(a.wood, a.stone, a.iron),
                        r = ResourcesForecaster.getForecast(d, game_data.village, BuildingMain.res_schedule.rates, BuildingMain.res_schedule.amounts);
                    if (
                        (!a.can_build && a.level
                            ? ((t = BuildingMain.BUILD_ERROR_REQ), (u = a.error))
                            : i > 1 && !premium
                            ? r.available === ResourcesForecast.AVAILABLE_NOW
                                ? ((t = BuildingMain.BUILD_ERROR_QUEUE), (u = _("e3191f3416af6c3c40af58132aceb0c8")))
                                : ((t = BuildingMain.BUILD_ERROR_RES), (u = r.toHTML()))
                            : a.pop && a.pop > parseInt(game_data.village.pop_max) - parseInt(game_data.village.pop)
                            ? ((t = BuildingMain.BUILD_ERROR_POP), (u = a.error))
                            : r.available !== ResourcesForecast.AVAILABLE_NOW && ((t = BuildingMain.BUILD_ERROR_RES), (u = r.toHTML())),
                        t == BuildingMain.BUILD_ERROR_RES && a.hasOwnProperty("wood_cheap"))
                    ) {
                        var o = e.hasEnough(new Resources(a.wood_cheap, a.stone_cheap, a.iron_cheap)),
                            s = l.find(".btn-bcr");
                        o && s.hasClass("btn-bcr-disabled") ? s.removeClass("btn-bcr-disabled") : o || s.hasClass("btn-bcr-disabled") || s.addClass("btn-bcr-disabled");
                    }
                    if (void 0 === u && a.hasOwnProperty("wood_queue_factor"))
                        e.hasEnough(new Resources(a.wood_queue_factor, a.stone_queue_factor, a.iron_queue_factor)) || ((t = BuildingMain.BUILD_ERROR_QUEUE_RES), (u = _("f43d707f8c0760ac530ca8441b9bbc17")));
                    var c = l.find(".btn-build"),
                        b = l.find(".inactive");
                    void 0 !== u ? (c.hide(), b.show(), b.html() != u && b.html(u)) : (c.show(), b.hide());
                }
            });
        }
    },
    init_buildbuttons: function () {
        $("#building_wrapper").on("click", ".btn-build", function () {
            var i = $(this);
            return BuildingMain.build(i.data("building")), !1;
        }),
            $("#building_wrapper").on("click", ".btn-bcr", function () {
                var i = $(this);
                return !i.hasClass("btn-bcr-disabled") && (BuildingMain.build_reduced(i.data("cost"), i.data("building")), !1);
            });
    },
    init_buildqueue: function (i) {
        $("#buildqueue").sortable({
            axis: "y",
            handle: ".bqhandle",
            helper: function (i, e) {
                var n = e.children(),
                    a = e.clone();
                return (
                    a.children().each(function (i) {
                        $(this).width(n.eq(i).width());
                    }),
                    a
                );
            },
            stop: function (e, n) {
                TribalWars.post(
                    i,
                    {},
                    $("#buildqueue").sortable("serialize"),
                    function (e) {
                        BuildingMain.init_buildqueue(i), BuildingMain.update_all(e);
                    },
                    function () {
                        $("#buildqueue").sortable("cancel");
                    }
                );
            },
        }),
            $("#buildqueue").sortable("option", "items", ".sortable_row");
    },
    init_mobilebuildqueue: function (i) {
        MDS.orderableQueue.init($("#buildqueue_wrap").find("div").first(), i, function (i) {
            BuildingMain.update_all(i);
        });
    },
    build: function (i, e) {
        var n = function () {
            var n = ++BuildingMain.request_id,
                a = { id: i, force: 1, destroy: BuildingMain.mode, source: game_data.village.id };
            void 0 !== e && (a.cheap = 1);
            var l = 0 == BuildingMain.mode ? BuildingMain.upgrade_building_link : BuildingMain.downgrade_building_link;
            TribalWars.post(l, {}, a, function (i) {
                n > BuildingMain.last_request_id && ((BuildingMain.last_request_id = n), BuildingMain.update_all(i), $(".popup_box").length || UI.SuccessMessage(_("2ccbefa6927a551c8b66f24b121323c6")));
            }),
                "main" === i && parseInt(game_data.village.buildings.main) >= 3 && BuildingMain.web_push.showPrompt();
        };
        if (BuildingMain.confirm_queue && 0 == this.mode) {
            var a = _("8beeb963ec4430bddbbe90d2e6a930d8"),
                l = [{ text: _("70d9be9b139893aa6c69b5e77e614311"), callback: n, confirm: !0 }];
            UI.ConfirmationBox(a, l);
        } else n();
        return !1;
    },
    destroy: function (i) {
        return BuildingMain.build(i);
    },
    build_reduced: function (i, e) {
        return (
            Premium.check("BuildCostReduction", i, function () {
                return BuildingMain.build(e, 1);
            }),
            !1
        );
    },
    cancel: function (i, e) {
        var n;
        n = e ? _("b30823e6b7339b73d0156dfa031cc060") + " " + _("4666fb30d85dc5cbc47135e12bfd746a") : _("b30823e6b7339b73d0156dfa031cc060");
        var a = [
            {
                text: _("70d9be9b139893aa6c69b5e77e614311"),
                callback: function () {
                    TribalWars.post(BuildingMain.link_cancel, null, { id: i, destroy: BuildingMain.mode }, function (i) {
                        BuildingMain.update_all(i);
                    });
                },
                confirm: !0,
            },
        ];
        return UI.ConfirmationBox(n, a), !1;
    },
    change_order: function (i, e, n) {
        var a = function () {
            TribalWars.get(BuildingMain.link_change_order, { id: i, destroy: BuildingMain.mode }, function (i) {
                BuildingMain.update_all(i);
            });
        };
        return n ? Premium.check(e, n, a) : a(), !1;
    },
    update_all: function (i) {
        var e = $("#buildqueue_wrap");
        if (
            (1 === e.length ? (i.building_orders ? e.replaceWith(i.building_orders) : e.remove()) : $("#building_wrapper").before(i.building_orders),
            i.next_buildings && ($("#building_wrapper").replaceWith(i.next_buildings), $(".inactive img").fadeTo(0, 0.5), BuildingMain.init_buildbuttons()),
            void 0 !== i.confirm_queue && (BuildingMain.confirm_queue = i.confirm_queue),
            void 0 !== i.population)
        ) {
            var n = $("#pop_current_label");
            n.html(i.population), changeResStyle(n, Format.get_warn_pop_class(i.population, game_data.village.pop_max, game_data.village.is_farm_upgradable));
        }
        "undefined" != typeof QuestArrows && QuestArrows.init(), OrderProgress.initProgress(), Premium.directBuy.init();
    },
    colorAffordability: function () {
        ["wood", "stone", "iron"].forEach(function (i) {
            $(".cost_" + i).each(function () {
                ($this = $(this)), $this.data("cost") > game_data.village[i] ? $this.addClass("warn") : $this.removeClass("warn");
            });
        });
    },
    Synchronizer: {
        notify: function (i, e) {
            this.handlers.hasOwnProperty(i) && this.handlers[i](e);
        },
        handlers: {
            res_schedule_invalid: function (i) {
                var e = game_data.village.id;
                i.village_id == e &&
                    (i.time_invalidated < BuildingMain.res_schedule.time_generated ||
                        ResourcesForecaster.fetchSchedules(e, function (i) {
                            i.time_generated > BuildingMain.res_schedule.time_generated && ((BuildingMain.res_schedule = i), BuildingMain.updateBuildableState());
                        }));
            },
        },
    },
};
