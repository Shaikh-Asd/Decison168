var base_url = 'http://localhost/decision168/';

//new flow of project chart start
var task_data;
var task_year = [];
var task_array = [];

var team_data;
var team_year = [];
var team_array = [];

var union_year = [];
//new flow of project chart end

//new flow of task chart start
var todo_data;
var todo_year;
var todo_array = [];

var pen_data;
var pen_year;
var pen_array = [];

var rev_data;
var rev_year;
var rev_array = [];

var done_data;
var done_year;
var done_array = [];

var union_task_year = [];
//new flow of task chart end

//new flow of subtask chart start
var subtodo_data;
var subtodo_year = [];
var subtodo_array = [];

var subpen_data;
var subpen_year = [];
var subpen_array = [];

var subrev_data;
var subrev_year = [];
var subrev_array = [];

var subdone_data;
var subdone_year = [];
var subdone_array = [];

var union_subtask_year = [];
//new flow of subtask chart end

//new flow of goal chart start
var goal_kpi_data;
var goal_kpi_year;
var goal_kpi_array = [];

var goal_project_data;
var goal_project_year;
var goal_project_array = [];

var goal_content_data;
var goal_content_year;
var goal_content_array = [];

var goal_task_data;
var goal_task_year;
var goal_task_array = [];

var union_goal_year = [];
//new flow of goal chart end

//new flow of Content chart start
var cnt_scl_data;
var cnt_scl_year;
var cnt_scl_array = [];

var cnt_social1;
var cnt_social1_year;
var cnt_scl1_array = [];

var cnt_social2;
var cnt_social2_year;
var cnt_scl2_array = [];


var cnt_social3;
var cnt_social3_year;
var cnt_scl3_array = [];

var cnt_social4;
var cnt_social4_year;
var cnt_scl4_array = [];


var cnt_social5;
var cnt_social5_year;
var cnt_scl5_array = [];


var cnt_social6;
var cnt_social6_year;
var cnt_scl6_array = [];

var cnt_social7;
var cnt_social7_year;
var cnt_scl7_array = [];

var cnt_social8;
var cnt_social8_year;
var cnt_scl8_array = [];

var cnt_social9;
var cnt_social9_year;
var cnt_scl9_array = [];

var cnt_task_data;
var cnt_task_year;
var cnt_task_array = [];

var cnt_team_data;
var cnt_team_year;
var cnt_team_array = [];

var union_cnt_year = [];
//new flow of Content chart end

//new flow of department chart start
var dep_prjt_data;
var dep_prjt_year;
var dep_prjt_array = [];

var dep_cnt_data;
var dep_cnt_year;
var dep_cnt_array = [];

var dep_task_data;
var dep_task_year;
var dep_task_array = [];

var dep_goal_data;
var dep_goal_year;
var dep_goal_array = [];

var union_dep_year = [];
//new flow of department chart end

//new flow of individual member chart start
var mem_prjt_data;
var mem_prjt_year;
var mem_prjt_array = [];

var mem_cnt_data;
var mem_cnt_year;
var mem_cnt_array = [];

var mem_task_data;
var mem_task_year;
var mem_task_array = [];

var mem_goal_data;
var mem_goal_year;
var mem_goal_array = [];

var mem_dep_data;
var mem_dep_year;
var mem_dep_array = [];

var mem_scl_data;
var mem_scl_year;
var mem_scl_array = [];

var union_mem_year = [];
//new flow of individual member chart end

var portfolio_id = $('#portfolio_id').val();
var selected_project = $('#selected_project');
var selected_depart = $('#selected_depart');
var selected_goal = $('#selected_goal');
var selected_content = $('#selected_content');
var selected_user = $('#selected_user').val();

$(document).ready(function() {
    "use strict";
    var ChartJs = function() {};

    ChartJs.prototype.respChart = function(selector, type, data, options) {
            var ctx = selector.get(0).getContext("2d");
            // pointing parent container to make chart js inherit its width
            var container = $(selector).parent();

            // enable resizing matter
            $(window).resize(generateChart);

            // this function produce the responsive Chart JS
            function generateChart() {
                // make chart width fit with its container
                var ww = selector.attr('width', $(container).width());
                switch (type) {
                    case 'Line':
                        new Chart(ctx, {
                            type: 'line',
                            data: data,
                            options: options
                        });
                        break;
                    case "Pie":
                        new Chart(ctx, {
                            type: "pie",
                            data: data,
                            options: options
                        });
                        break;
                    case "Bar":
                        new Chart(ctx, {
                            type: "bar",
                            data: data,
                            options: options
                        });
                        break;
                    case 'Doughnut':
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: data,
                            options: options
                        });
                        break;
                }
                // Initiate new chart or Redraw

            };
            // run function - render chart at first load
            generateChart();
        },

        //init
        ChartJs.prototype.init = function() {

            //new flow of task chart start
            // task todo
            taskChart();

            function taskChart() {
                $.ajax({
                    url: base_url + 'front/task_Usertodo',
                    type: 'post',
                    async: false,
                    data: {
                        portfolio_id: portfolio_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        var cnt_todo = data.length;
                        $('#task_todo').html(cnt_todo)

                        var result_todo = data.reduce((r, {
                            tdue_date
                        }) => {
                            var key = tdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        todo_data = result_todo;
                        todo_year = Object.keys(result_todo);
                    }
                });
            }

            taskChart2();

            function taskChart2() {
                $.ajax({
                    url: base_url + 'front/all_Usertask',
                    type: 'post',
                    async: false,
                    data: {
                        portfolio_id: portfolio_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        var tsk_prog = data.tsk_prog;
                        var tsk_rev = data.tsk_rev;
                        var tsk_done = data.tsk_done;
                        //in_progress
                        var cnt_prog = tsk_prog.length;
                        $('#task_prog').html(cnt_prog);
                        var result_pen = tsk_prog.reduce((r, {
                            tdue_date
                        }) => {
                            var key = tdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        pen_data = result_pen;
                        pen_year = Object.keys(result_pen);

                        //review
                        var cnt_rev = tsk_rev.length;
                        $('#task_rev').html(cnt_rev);
                        var result_rev = tsk_rev.reduce((r, {
                            tdue_date
                        }) => {
                            var key = tdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        rev_data = result_rev;
                        rev_year = Object.keys(result_rev);

                        //done
                        var cnt_done = tsk_done.length;
                        $('#task_done').html(cnt_done);
                        var result_done = tsk_done.reduce((r, {
                            tdue_date
                        }) => {
                            var key = tdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        done_data = result_done;
                        done_year = Object.keys(result_done);
                        if (todo_year || pen_year || rev_year || done_year) {
                            var mergetask_year = [...todo_year, ...pen_year, ...rev_year, ...done_year];
                            union_task_year = mergetask_year.filter(function(value, index, self) {
                                return self.indexOf(value) === index;
                            });
                            union_task_year.sort();

                            if (union_task_year) {
                                var year_task_count = union_task_year.length;
                                if (year_task_count) {
                                    var todo_array = [];
                                    for (var i = 0; i < year_task_count; i++) {
                                        if (todo_year.includes(union_task_year[i])) {
                                            var y1 = union_task_year[i];
                                            todo_array.push(todo_data[y1]);
                                        } else {
                                            todo_array.push(0);
                                        }
                                    }

                                    var pen_array = [];
                                    for (var j = 0; j < year_task_count; j++) {
                                        if (pen_year.includes(union_task_year[j])) {
                                            var y2 = union_task_year[j];
                                            pen_array.push(pen_data[y2]);
                                        } else {
                                            pen_array.push(0);
                                        }
                                    }

                                    var rev_array = [];
                                    for (var i = 0; i < year_task_count; i++) {
                                        if (rev_year.includes(union_task_year[i])) {
                                            var y1 = union_task_year[i];
                                            rev_array.push(rev_data[y1]);
                                        } else {
                                            rev_array.push(0);
                                        }
                                    }

                                    var done_array = [];
                                    for (var j = 0; j < year_task_count; j++) {
                                        if (done_year.includes(union_task_year[j])) {
                                            var y2 = union_task_year[j];
                                            done_array.push(done_data[y2]);
                                        } else {
                                            done_array.push(0);
                                        }
                                    }
                                }
                            }
                        }
                        // task start
                        var lineChart = {

                            labels: Object.values(union_task_year || {}),
                            datasets: [{
                                    label: "Todo",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(85, 110, 230, 0.2)",
                                    borderColor: "#556ee6",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#556ee6",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#556ee6",
                                    pointHoverBorderColor: "#fff",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(todo_array || {})
                                },
                                {
                                    label: "Pending",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(235, 239, 242, 0.2)",
                                    borderColor: "#ebeff2",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#ebeff2",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#ebeff2",
                                    pointHoverBorderColor: "#eef0f2",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(pen_array || {})
                                },
                                {
                                    label: "Review",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(85, 110, 230, 0.2)",
                                    borderColor: "#39563c ",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#39563c ",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#39563c ",
                                    pointHoverBorderColor: "#fff",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(rev_array || {})
                                },
                                {
                                    label: "Done",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(235, 239, 242, 0.2)",
                                    borderColor: "#512013",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#512013",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#512013",
                                    pointHoverBorderColor: "#ff0a00",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(done_array || {})
                                }
                            ]
                        };
                        var lineOpts = {
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }]
                            }
                        };
                        $.ChartJs.respChart($("#lineChart"), 'Line', lineChart, lineOpts);
                        // task end
                    }
                });
            }
            //new flow of task chart end


            //new flow of subtask chart start

            subtaskChart();

            function subtaskChart() {
                $.ajax({
                    url: base_url + 'front/subtask_Usertodo',
                    type: 'post',
                    data: {
                        portfolio_id: portfolio_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);
                        var cnt_subtodo = data.length;
                        $('#subtask_todo').html(cnt_subtodo)
                        var result_subtodo = data.reduce((r, {
                            stdue_date
                        }) => {
                            var key = stdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        subtodo_data = result_subtodo;
                        subtodo_year = Object.keys(result_subtodo);
                    }
                });
            }

            subtaskChart2();

            function subtaskChart2() {
                $.ajax({
                    url: base_url + 'front/all_Usersubtask',
                    type: 'post',
                    data: {
                        portfolio_id: portfolio_id
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        var subtsk_userprog = data.subtsk_userprog;
                        var subtsk_userrev = data.subtsk_userrev;
                        var subtsk_userdone = data.subtsk_userdone;
                        //in_progress
                        var cnt_subprog = subtsk_userprog.length;
                        $('#subtask_prog').html(cnt_subprog);
                        var result_subpen = subtsk_userprog.reduce((r, {
                            stdue_date
                        }) => {
                            var key = stdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        subpen_data = result_subpen;
                        subpen_year = Object.keys(result_subpen);

                        //review
                        var cnt_subrev = subtsk_userrev.length;
                        $('#subtask_rev').html(cnt_subrev);
                        var result_subrev = subtsk_userrev.reduce((r, {
                            stdue_date
                        }) => {
                            var key = stdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        subrev_data = result_subrev;
                        subrev_year = Object.keys(result_subrev);

                        //done
                        var cnt_subdone = subtsk_userdone.length;
                        $('#subtask_done').html(cnt_subdone);
                        var result_subdone = subtsk_userdone.reduce((r, {
                            stdue_date
                        }) => {
                            var key = stdue_date.slice(0, 7);
                            r[key] = (r[key] || 0) + 1;
                            return r;
                        }, {});
                        subdone_data = result_subdone;
                        subdone_year = Object.keys(result_subdone);
                        if (subtodo_year || subpen_year || subrev_year || subdone_year) {
                            // var mergesubtask_year = subtodo_year.concat(subpen_year, subrev_year, subdone_year);
                            var mergesubtask_year = [...subtodo_year, ...subpen_year, ...subrev_year, ...subdone_year];
                            union_subtask_year = mergesubtask_year.filter(function(value, index, self) {
                                return self.indexOf(value) === index;
                            });
                            union_subtask_year.sort();

                            if (union_subtask_year) {
                                var year_subtask_count = union_subtask_year.length;
                                if (year_subtask_count) {
                                    var subtodo_array = [];
                                    for (var i = 0; i < year_subtask_count; i++) {
                                        if (subtodo_year.includes(union_subtask_year[i])) {
                                            var y1 = union_subtask_year[i];
                                            subtodo_array.push(subtodo_data[y1]);
                                        } else {
                                            subtodo_array.push(0);
                                        }
                                    }

                                    var subpen_array = [];
                                    for (var j = 0; j < year_subtask_count; j++) {
                                        if (subpen_year.includes(union_subtask_year[j])) {
                                            var y2 = union_subtask_year[j];
                                            subpen_array.push(subpen_data[y2]);
                                        } else {
                                            subpen_array.push(0);
                                        }
                                    }

                                    var subrev_array = [];
                                    for (var i = 0; i < year_subtask_count; i++) {
                                        if (subrev_year.includes(union_subtask_year[i])) {
                                            var y1 = union_subtask_year[i];
                                            subrev_array.push(subrev_data[y1]);
                                        } else {
                                            subrev_array.push(0);
                                        }
                                    }

                                    var subdone_array = [];
                                    for (var j = 0; j < year_subtask_count; j++) {
                                        if (subdone_year.includes(union_subtask_year[j])) {
                                            var y2 = union_subtask_year[j];
                                            subdone_array.push(subdone_data[y2]);
                                        } else {
                                            subdone_array.push(0);
                                        }
                                    }
                                }
                            }
                        }
                        // subtask start
                        var lineChart_subtask = {

                            labels: Object.values(union_subtask_year || {}),
                            datasets: [{
                                    label: "Todo",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(179, 120, 88, 0.2)",
                                    borderColor: "#a93856",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#a93856",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#a93856",
                                    pointHoverBorderColor: "#fff",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(subtodo_array || {})
                                },
                                {
                                    label: "In Progress",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(162, 167, 191, 0.2)",
                                    borderColor: "#fff700",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#fff700",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#fff700",
                                    pointHoverBorderColor: "#eef0f2",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(subpen_array || {})
                                },
                                {
                                    label: "In Review",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(143, 171, 144, 0.2)",
                                    borderColor: "#00ff47 ",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#00ff47 ",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#00ff47 ",
                                    pointHoverBorderColor: "#fff",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(subrev_array || {})
                                },
                                {
                                    label: "Done",
                                    fill: true,
                                    lineTension: 0.5,
                                    backgroundColor: "rgba(235, 239, 242, 0.2)",
                                    borderColor: "#00e5ca",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "#00e5ca",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "#00e5ca",
                                    pointHoverBorderColor: "#ff0a00",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 1,
                                    pointHitRadius: 10,
                                    data: Object.values(subdone_array || {})
                                }
                            ]
                        };
                        // function done(){
                        //     // alert("haha");
                        //     var url=myLine.toBase64Image();
                        //     document.getElementById("url").src=url;
                        //     // console.log(url);
                        //   }
                        var lineOpts_subtask = {
                            // bezierCurve : false,
                            // animation: {
                            //     onComplete: done
                            //   },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                    }
                                }]
                            }
                        };
                        $.ChartJs.respChart($("#lineChart_subtask"), 'Line', lineChart_subtask, lineOpts_subtask);
                        var myLine_subtask = new Chart(document.getElementById("lineChart_subtask").getContext("2d"), {
                            data: lineChart_subtask,
                            type: "line",
                            options: lineOpts_subtask
                        });
                        // subtask end
                    }
                });
            }
            //new flow of subtask chart end

            setTimeout(function() {
                //new flow of goal and stratgies chart start
                var options_goal = {
                        chart: {
                            height: 350,
                            type: "line",
                            zoom: {
                                enabled: !1
                            },
                            toolbar: {
                                show: !1
                            }
                        },
                        colors: ["#556ee6", "#34c38f", "#963e3e", "#8a963e"],
                        dataLabels: {
                            enabled: !1
                        },
                        stroke: {
                            width: [3, 3],
                            curve: "straight"
                        },
                        series: [{
                            name: "KPI's",
                            data: Object.values(goal_kpi_array || {})
                        }, {
                            name: 'Project',
                            data: Object.values(goal_project_array || {})
                        }, {
                            name: 'Content Project',
                            data: Object.values(goal_content_array || {})
                        }, {
                            name: 'Task',
                            data: Object.values(goal_task_array || {})
                        }],
                        title: {
                            // text: "Average High & Low Temperature",
                            align: "left",
                            style: {
                                fontWeight: "500"
                            }
                        },
                        grid: {
                            row: {
                                colors: ["transparent", "transparent"],
                                opacity: .2
                            },
                            borderColor: "#f1f1f1"
                        },
                        markers: {
                            style: "inverted",
                            size: 6
                        },
                        xaxis: {
                            categories: Object.values(union_goal_year),
                        },
                        yaxis: {
                            title: {
                                text: ""
                            },
                        },
                        legend: {
                            position: "top",
                            horizontalAlign: "right",
                            floating: !0,
                            offsetY: -25,
                            offsetX: -5
                        },
                        responsive: [{
                            breakpoint: 600,
                            options: {
                                chart: {
                                    toolbar: {
                                        show: !1
                                    }
                                },
                                legend: {
                                    show: !1
                                }
                            }
                        }]
                    },
                    chart_goal = new ApexCharts(document.querySelector("#line_chart_datalabel"), options_goal);
                chart_goal.render();
                $('#selected_goal').on('change', function(event) {
                    $('#selected_goal').attr('disabled', 'disabled');
                    goalChart();
                    setTimeout(function() {
                        $('#selected_goal').removeAttr('disabled');
                    }, 1000);
                });

                goalChart();

                function goalChart() {
                    $.ajax({
                        url: base_url + 'front/all_Usergoal',
                        type: 'post',
                        data: {
                            portfolio_id: portfolio_id,
                            goal_id: selected_goal.val()

                        },
                        success: function(data) {

                            var data = JSON.parse(data);

                            var goal_kpi = data.goal_kpi;
                            var goal_pro = data.goal_pro;
                            var goal_cnt = data.goal_cnt;
                            var goal_task = data.goal_task;

                            //kpi
                            var total_gaolKPI = goal_kpi.length;
                            $('#gaolKPI').html(total_gaolKPI);

                            var result_glkpi = goal_kpi.reduce((r, {
                                screated_date
                            }) => {
                                var key = screated_date.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            goal_kpi_data = result_glkpi;
                            goal_kpi_year = Object.keys(result_glkpi);

                            //project
                            var total_goalPro = goal_pro.length;
                            $('#goalPro').html(total_goalPro);
                            var result_glprjt = goal_pro.reduce((r, {
                                pcreated_date
                            }) => {
                                var key = pcreated_date.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            goal_project_data = result_glprjt;
                            goal_project_year = Object.keys(result_glprjt);

                            // content
                            var total_goalCnt = goal_cnt.length;
                            $('#goalCnt').html(total_goalCnt);

                            var result_glcnt = goal_cnt.reduce((r, {
                                p_publish
                            }) => {
                                var key = p_publish.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            goal_content_data = result_glcnt;
                            goal_content_year = Object.keys(result_glcnt);

                            // task
                            var total_goalTask = goal_task.length;
                            $('#goalTask').html(total_goalTask);

                            var result_gltask = goal_task.reduce((r, {
                                tdue_date
                            }) => {
                                var key = tdue_date.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            goal_task_data = result_gltask;
                            goal_task_year = Object.keys(result_gltask);
                            if (goal_kpi_year || goal_project_year || goal_content_year || goal_task_year) {
                                union_goal_year = goal_kpi_year.concat(goal_project_year, goal_content_year, goal_task_year).filter(function(value, index, self) {
                                    return self.indexOf(value) === index;
                                });
                                union_goal_year.sort();
                                if (union_goal_year) {
                                    var year_goal_count = union_goal_year.length;
                                    if (year_goal_count) {
                                        var goal_kpi_array = [];
                                        for (var i = 0; i < year_goal_count; i++) {
                                            if (goal_kpi_year.includes(union_goal_year[i])) {
                                                var y1 = union_goal_year[i];
                                                goal_kpi_array.push(goal_kpi_data[y1]);
                                            } else {
                                                goal_kpi_array.push(0);
                                            }
                                        }
                                        var goal_project_array = [];
                                        for (var j = 0; j < year_goal_count; j++) {
                                            if (goal_project_year.includes(union_goal_year[j])) {
                                                var y2 = union_goal_year[j];
                                                goal_project_array.push(goal_project_data[y2]);
                                            } else {
                                                goal_project_array.push(0);
                                            }
                                        }

                                        var goal_content_array = [];
                                        for (var i = 0; i < year_goal_count; i++) {
                                            if (goal_content_year.includes(union_goal_year[i])) {
                                                var y1 = union_goal_year[i];
                                                goal_content_array.push(goal_content_data[y1]);
                                            } else {
                                                goal_content_array.push(0);
                                            }
                                        }
                                        var goal_task_array = [];
                                        for (var j = 0; j < year_goal_count; j++) {
                                            if (goal_task_year.includes(union_goal_year[j])) {
                                                var y2 = union_goal_year[j];
                                                goal_task_array.push(goal_task_data[y2]);
                                            } else {
                                                goal_task_array.push(0);
                                            }
                                        }
                                    }
                                }
                            }
                            chart_goal.updateOptions({

                                chart: {
                                    height: 350,
                                    type: "line",
                                    zoom: {
                                        enabled: !1
                                    },
                                    toolbar: {
                                        show: !1
                                    }
                                },
                                colors: ["#556ee6", "#34c38f", "#963e3e", "#8a963e"],
                                dataLabels: {
                                    enabled: !1
                                },
                                stroke: {
                                    width: [3, 3],
                                    curve: "straight"
                                },
                                series: [{
                                    name: "KPI's",
                                    data: Object.values(goal_kpi_array || {})
                                }, {
                                    name: 'Project',
                                    data: Object.values(goal_project_array || {})
                                }, {
                                    name: 'Content Project',
                                    data: Object.values(goal_content_array || {})
                                }, {
                                    name: 'Task',
                                    data: Object.values(goal_task_array || {})
                                }],
                                title: {
                                    text: ".",
                                    align: "left",
                                    style: {
                                        fontWeight: "500"
                                    }
                                },
                                grid: {
                                    row: {
                                        colors: ["transparent", "transparent"],
                                        opacity: .2
                                    },
                                    borderColor: "#f1f1f1"
                                },
                                markers: {
                                    style: "inverted",
                                    size: 6
                                },
                                xaxis: {
                                    categories: Object.values(union_goal_year || {}),
                                },
                                yaxis: {
                                    title: {
                                        text: ""
                                    },
                                },
                                legend: {
                                    position: "top",
                                    horizontalAlign: "right",
                                    floating: !0,
                                    offsetY: -25,
                                    offsetX: -5
                                },
                                responsive: [{
                                    breakpoint: 600,
                                    options: {
                                        chart: {
                                            toolbar: {
                                                show: !1
                                            }
                                        },
                                        legend: {
                                            show: !1
                                        }
                                    }
                                }]
                            });
                        }
                    });
                }
                //new flow of goal and stratgies chart end

                //new flow of project chart start
                var chart_project = new ApexCharts(document.querySelector('#spline_area'), {
                    series: [{
                            name: 'Task',
                            data: Object.values(task_array || {})
                        },
                        {
                            name: 'Team Member',
                            data: Object.values(team_array || {})
                        }
                    ],
                    chart: {
                        height: 350,
                        type: "area",
                        toolbar: {
                            show: !1
                        }
                    },
                    xaxis: {
                        categories: Object.values(union_year || {}),
                    },
                    dataLabels: {
                        enabled: true,
                        enabledOnSeries: [1]
                    },

                });
                chart_project.render();
                $('#selected_project').on('change', function(event) {
                    $('#selected_project').attr('disabled', 'disabled');
                    projectChart();
                    setTimeout(function() {
                        $('#selected_project').removeAttr('disabled');
                    }, 1000);
                });

                projectChart();

                function projectChart() {
                    $.ajax({
                        url: base_url + 'front/all_Userproject',
                        type: 'post',
                        data: {
                            portfolio_id: portfolio_id,
                            project_id: selected_project.val()
                        },
                        success: function(data) {
                            var data = JSON.parse(data);

                            var one = data.pro_task;
                            var two = data.pro_member;

                            const total = one.length;
                            $('#protask').html(total);

                            var dt = two.length;
                            $('#proteam').html(dt);

                            //task
                            var result = one.reduce((r, {
                                tdue_date
                            }) => {
                                var key = tdue_date.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            task_data = result;
                            task_year = Object.keys(result);

                            //team
                            var result_team = two.reduce((r, {
                                sent_date
                            }) => {
                                var key = sent_date.slice(0, 7);
                                r[key] = (r[key] || 0) + 1;
                                return r;
                            }, {});
                            team_data = result_team;
                            team_year = Object.keys(result_team);

                            if (task_year || team_year) {
                                union_year = task_year.concat(team_year).filter(function(value, index, self) {
                                    return self.indexOf(value) === index;
                                });
                                union_year.sort();

                                if (union_year) {
                                    var year_count = union_year.length;
                                    if (year_count) {
                                        var team_array = [];
                                        for (var i = 0; i < year_count; i++) {
                                            if (team_year.includes(union_year[i])) {
                                                var y1 = union_year[i];
                                                team_array.push(team_data[y1]);
                                            } else {
                                                team_array.push(0);
                                            }
                                        }

                                        var task_array = [];
                                        for (var j = 0; j < year_count; j++) {
                                            if (task_year.includes(union_year[j])) {
                                                var y2 = union_year[j];
                                                task_array.push(task_data[y2]);
                                            } else {
                                                task_array.push(0);
                                            }
                                        }
                                    }
                                }
                            }
                            chart_project.updateOptions({
                                series: [{
                                        name: 'Task',
                                        data: Object.values(task_array || {})
                                    },
                                    {
                                        name: 'Team Member',
                                        data: Object.values(team_array || {})
                                    }
                                ],
                                xaxis: {
                                    categories: Object.values(union_year || {}),
                                },
                                yaxis: {
                                    display: true,
                                    beginAtZero: true,
                                }
                            });
                        }
                    });
                }
                //new flow of project chart end
            }, 2000);


            // //new flow of Portfolio member chart start
            // var active = $('#active').val();
            // var inactive = $('#inactive').val();
            // var donutChart = {
            //
            //     labels: [
            //         "Activated",
            //         "Deactivated"
            //     ],
            //     datasets: [{
            //         data: [active, inactive],
            //         backgroundColor: [
            //             "#556ee6",
            //             "#ebeff2"
            //         ],
            //         hoverBackgroundColor: [
            //             "#556ee6",
            //             "#ebeff2"
            //         ],
            //         hoverBorderColor: "#fff"
            //     }],
            //
            // };
            // this.respChart($("#doughnut"), 'Doughnut', donutChart);
            // //new flow of Portfolio member chart end
        },
        $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs
    $.ChartJs.init();
});

//new flow of department chart start
const chart_department = new ApexCharts(document.querySelector('#mixed_chart'), {
    chart: {
        height: 350,
        type: "line",
        stacked: !1,
        toolbar: {
            show: !1
        }
    },
    stroke: {
        width: [0, 2, 4],
        curve: "smooth"
    },
    plotOptions: {
        bar: {
            columnWidth: "50%"
        }
    },
    colors: ["#f46a6a", "#556ee6", "#34c38f", "#c7df19"],
    series: [{
        name: "Project",
        type: "column",
        data: Object.values(dep_prjt_array || {})

    }, {
        name: "Content Planner",
        type: "area",
        data: Object.values(dep_cnt_array || {})
    }, {
        name: "Task",
        type: "line",
        data: Object.values(dep_task_array || {})

    }, {
        name: "Goal",
        type: "bar",
        data: Object.values(dep_goal_array || {})

    }],
    fill: {
        opacity: [.85, .25, 1],
        gradient: {
            inverseColors: !1,
            shade: "light",
            type: "vertical",
            opacityFrom: .85,
            opacityTo: .55,
            stops: [0, 100, 100, 100]
        }
    },
    labels: Object.values(union_dep_year || {}),
    markers: {
        size: 0
    },
    xaxis: {},
    yaxis: {
        title: {
            // text: "Points"
        },
    },
    tooltip: {
        shared: !0,
        intersect: !1,
        y: {
            formatter: function(e) {
                return void 0 !== e ? e.toFixed(0) + " points" : e
            }
        }
    },
    grid: {
        borderColor: "#f1f1f1"
    }
});
chart_department.render();

$('#selected_depart').on('change', function(event) {
    $('#selected_depart').attr('disabled', 'disabled');
    departmentChart();
    setTimeout(function() {
        $('#selected_depart').removeAttr('disabled');
    }, 1000);
});

departmentChart();

function departmentChart() {
    $.ajax({
        url: base_url + 'front/all_Userdepartment',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            department_id: selected_depart.val()
        },
        success: function(data) {

            var data = JSON.parse(data);

            var dep_project = data.dep_pro;
            var dep_content = data.dep_cnt;
            var dep_task = data.dep_task;
            var dep_goal = data.dep_goal;

            // deaprtmet project
            var total_depPro = dep_project.length;
            $('#depPro').html(total_depPro);
            var result_prjt = dep_project.reduce((r, {
                pcreated_date
            }) => {
                var key = pcreated_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_prjt_data = result_prjt;
            dep_prjt_year = Object.keys(result_prjt);

            // deaprtmet conetnt
            var total_depCnt = dep_content.length;
            $('#depCnt').html(total_depCnt);

            var result_dcnt = dep_content.reduce((r, {
                p_publish
            }) => {
                var key = p_publish.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_cnt_data = result_dcnt;
            dep_cnt_year = Object.keys(result_dcnt);

            // deaprtmet task
            var total_depTask = dep_task.length;
            $('#depTask').html(total_depTask);
            var result_dtask = dep_task.reduce((r, {
                tdue_date
            }) => {
                var key = tdue_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_task_data = result_dtask;
            dep_task_year = Object.keys(result_dtask);

            // deaprtmet goal
            var total_depGaol = dep_goal.length;
            $('#depGaol').html(total_depGaol);
            var result_dgoal = dep_goal.reduce((r, {
                gstart_date
            }) => {
                var key = gstart_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_goal_data = result_dgoal;
            dep_goal_year = Object.keys(result_dgoal);

            if (dep_prjt_year || dep_cnt_year || dep_task_year || dep_goal_year) {
                var union_dep_year = dep_prjt_year.concat(dep_cnt_year, dep_task_year, dep_goal_year).filter(function(value, index, self) {
                    return self.indexOf(value) === index;
                });
                union_dep_year.sort();
                if (union_dep_year) {
                    var year_dep_count = union_dep_year.length;
                    if (year_dep_count) {
                        var dep_prjt_array = [];
                        for (var i = 0; i < year_dep_count; i++) {
                            if (dep_prjt_year.includes(union_dep_year[i])) {
                                var y1 = union_dep_year[i];
                                dep_prjt_array.push(dep_prjt_data[y1]);
                            } else {
                                dep_prjt_array.push(0);
                            }
                        }
                        var dep_cnt_array = [];
                        for (var j = 0; j < year_dep_count; j++) {
                            if (dep_cnt_year.includes(union_dep_year[j])) {
                                var y2 = union_dep_year[j];
                                dep_cnt_array.push(dep_cnt_data[y2]);
                            } else {
                                dep_cnt_array.push(0);
                            }
                        }
                        var dep_task_array = [];
                        for (var i = 0; i < year_dep_count; i++) {
                            if (dep_task_year.includes(union_dep_year[i])) {
                                var y1 = union_dep_year[i];
                                dep_task_array.push(dep_task_data[y1]);
                            } else {
                                dep_task_array.push(0);
                            }
                        }
                        var dep_goal_array = [];
                        for (var j = 0; j < year_dep_count; j++) {
                            if (dep_goal_year.includes(union_dep_year[j])) {
                                var y2 = union_dep_year[j];
                                dep_goal_array.push(dep_goal_data[y2]);
                            } else {
                                dep_goal_array.push(0);
                            }
                        }
                    }
                }
            }
            chart_department.updateOptions({
                chart: {
                    height: 350,
                    type: "line",
                    stacked: !1,
                    toolbar: {
                        show: !1
                    }
                },
                stroke: {
                    width: [0, 2, 4],
                    curve: "smooth"
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%"
                    }
                },
                colors: ["#f46a6a", "#556ee6", "#34c38f", "#c7df19"],
                series: [{
                        name: "Project",
                        type: "column",
                        data: Object.values(dep_prjt_array || {})
                    }, {
                        name: "Content Planner",
                        type: "area",
                        data: Object.values(dep_cnt_array || {})

                    }, {
                        name: "Task",
                        type: "line",
                        data: Object.values(dep_task_array || {})

                    },
                    {
                        name: 'Goal',
                        type: "bar",
                        data: Object.values(dep_goal_array || {})
                    }
                ],
                fill: {
                    opacity: [.85, .25, 1],
                    gradient: {
                        inverseColors: !1,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: .85,
                        opacityTo: .55,
                        stops: [0, 100, 100, 100]
                    }
                },
                labels: Object.values(union_dep_year),

                markers: {
                    size: 0
                },
                xaxis: {},
                yaxis: {
                    title: {
                        // text: "Points"
                    },
                },
                tooltip: {
                    shared: !0,
                    intersect: !1,
                    y: {
                        formatter: function(e) {
                            return void 0 !== e ? e.toFixed(0) + " points" : e
                        }
                    }
                },
                grid: {
                    borderColor: "#f1f1f1"
                }
            });
        }
    });
}
//new flow of department chart end


//new flow of Content chart start
$('#selected_content').on('change', function(event) {
    $('#area-charts').html('');
    $('#selected_content').attr('disabled', 'disabled');
    contentChart();
    setTimeout(function() {
        $('#selected_content').removeAttr('disabled');
    }, 1000);
});

contentChart();

function contentChart() {
    $.ajax({
        url: base_url + 'front/all_Usercontent',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            content_id: selected_content.val()
        },
        success: function(data) {
            var data = JSON.parse(data);
            var content_pln = data.content_pln;
            var content_task = data.content_task;
            var content_mem = data.content_mem;


            var social1 = data.user_social1;
            var social2 = data.user_social2;
            var social3 = data.user_social3;
            var social4 = data.user_social4;
            var social5 = data.user_social5;
            var social6 = data.user_social6;
            var social7 = data.user_social7;
            var social8 = data.user_social8;
            var social9 = data.user_social9;


            if (data == '-1') {
                $('#cntScl').html('0');
                $('#cnttask').html('0');
                $('#cntteam').html('0');

                var areaChartWidth = $("#area-charts").width();
                var container_area_charts = document.getElementById('area-charts');
                var datas_content = {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    // categories: Object.values(union_cnt_year),
                    series: [
                        // {
                        //       name: 'Social Content',
                        //       data: [0, 0, 0, 0, 0, 0]
                        //   },
                        {
                            name: 'Task',
                            data: [0, 0, 0, 0, 0, 0]
                        },
                        {
                            name: 'Teams',
                            data: [0, 0, 0, 0, 0, 0]

                        }
                    ]
                };
                var options_content = {
                    chart: {
                        width: areaChartWidth,
                        height: 350,
                    },
                    series: {
                        zoomable: true,
                        showDot: true,
                        areaOpacity: 1
                    },
                    yAxis: {
                        // min:0,
                        // max:10,
                        // stepSize:1
                    },
                    xAxis: {
                        // title: 'Month'
                    },
                    tooltip: {
                        // suffix: '°C'
                    }
                };
                var theme = {
                    chart: {
                        background: {
                            color: '#fff',
                            opacity: 0
                        },
                    },
                    title: {
                        color: '#8791af',
                    },
                    xAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'
                    },
                    yAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'

                    },
                    plot: {
                        lineColor: 'rgba(166, 176, 207, 0.1)'
                    },
                    legend: {
                        label: {
                            color: '#8791af'
                        }
                    },
                    series: {
                        colors: [
                            '#f46a6a', '#34c38f', '#556ee6'
                        ]
                    }
                };
                // For apply theme
                tui.chart.registerTheme('myTheme', theme);
                options_content.theme = 'myTheme';
                var areaChart = tui.chart.areaChart(container_area_charts, datas_content, options_content);
            } else if (data) {

                // var total_cntScl = content_pln.length;
                // $('#cntScl').html(total_cntScl);

                var total_cnttask = content_task.length;
                $('#cnttask').html(total_cnttask);

                var total_cntteam = content_mem.length;
                $('#cntteam').html(total_cntteam);
                //social planner
                // var result_social = content_pln.reduce((r, {
                //     pc_created_date
                // }) => {
                //     var key = pc_created_date.slice(0, 7);
                //     r[key] = (r[key] || 0) + 1;
                //     return r;
                // }, {});
                // cnt_scl_data = result_social;
                // cnt_scl_year = Object.keys(result_social);


                var result_social1 = social1.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social1 = result_social1;
                cnt_social1_year = Object.keys(result_social1);

                var result_social2 = social2.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social2 = result_social2;
                cnt_social2_year = Object.keys(result_social2);


                var result_social3 = social3.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social3 = result_social3;
                cnt_social3_year = Object.keys(result_social3);

                var result_social4 = social4.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social4 = result_social4;
                cnt_social4_year = Object.keys(result_social4);

                var result_social5 = social5.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social5 = result_social5;
                cnt_social5_year = Object.keys(result_social5);

                var result_social6 = social6.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social6 = result_social6;
                cnt_social6_year = Object.keys(result_social6);

                var result_social7 = social7.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social7 = result_social7;
                cnt_social7_year = Object.keys(result_social7);


                var result_social8 = social8.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social8 = result_social8;
                cnt_social8_year = Object.keys(result_social8);

                var result_social9 = social9.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social9 = result_social9;
                cnt_social9_year = Object.keys(result_social9);

                //task
                var result_task = content_task.reduce((r, {
                    tdue_date
                }) => {
                    var key = tdue_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_task_data = result_task;
                cnt_task_year = Object.keys(result_task);

                //team
                var result_task = content_mem.reduce((r, {
                    sent_date
                }) => {
                    var key = sent_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_team_data = result_task;
                cnt_team_year = Object.keys(result_task);
                // console.log(cnt_team_data);
                if (cnt_task_year || cnt_team_year) {
                    union_cnt_year = cnt_task_year.concat(cnt_social1_year, cnt_social2_year, cnt_social3_year, cnt_social4_year, cnt_social5_year, cnt_social6_year, cnt_social7_year, cnt_social8_year, cnt_social9_year, cnt_team_year).filter(function(value, index, self) {
                        return self.indexOf(value) === index;
                    });
                    union_cnt_year.sort();
                    if (union_cnt_year) {
                        var year_cnt_count = union_cnt_year.length;
                        if (year_cnt_count) {
                            // var cnt_scl_array = [];
                            // for (var i = 0; i < year_cnt_count; i++) {
                            //     if (cnt_scl_year.includes(union_cnt_year[i])) {
                            //         var y1 = union_cnt_year[i];
                            //         cnt_scl_array.push(cnt_scl_data[y1]);
                            //     } else {
                            //         cnt_scl_array.push(0);
                            //     }
                            // }

                            var cnt_scl1_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social1_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl1_array.push(cnt_social1[y1]);
                                } else {
                                    cnt_scl1_array.push(0);
                                }
                            }

                            var cnt_scl2_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social2_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl2_array.push(cnt_social2[y1]);
                                } else {
                                    cnt_scl2_array.push(0);
                                }
                            }

                            var cnt_scl3_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social3_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl3_array.push(cnt_social3[y1]);
                                } else {
                                    cnt_scl3_array.push(0);
                                }
                            }

                            var cnt_scl4_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social4_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl4_array.push(cnt_social4[y1]);
                                } else {
                                    cnt_scl4_array.push(0);
                                }
                            }

                            var cnt_scl5_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social5_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl5_array.push(cnt_social5[y1]);
                                } else {
                                    cnt_scl5_array.push(0);
                                }
                            }

                            var cnt_scl6_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social6_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl6_array.push(cnt_social6[y1]);
                                } else {
                                    cnt_scl6_array.push(0);
                                }
                            }


                            var cnt_scl7_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social7_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl7_array.push(cnt_social7[y1]);
                                } else {
                                    cnt_scl7_array.push(0);
                                }
                            }

                            var cnt_scl8_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social8_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl8_array.push(cnt_social8[y1]);
                                } else {
                                    cnt_scl8_array.push(0);
                                }
                            }

                            var cnt_scl9_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social9_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl9_array.push(cnt_social9[y1]);
                                } else {
                                    cnt_scl9_array.push(0);
                                }
                            }

                            var cnt_task_array = [];
                            for (var j = 0; j < year_cnt_count; j++) {
                                if (cnt_task_year.includes(union_cnt_year[j])) {
                                    var y2 = union_cnt_year[j];
                                    cnt_task_array.push(cnt_task_data[y2]);
                                } else {
                                    cnt_task_array.push(0);
                                }
                            }
                            var cnt_team_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_team_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_team_array.push(cnt_team_data[y1]);
                                } else {
                                    cnt_team_array.push(0);
                                }
                            }
                        }
                    }
                }
                var areaChartWidth = $("#area-charts").width();
                var container_area_charts = document.getElementById('area-charts');
                var datas_content = {
                    // categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    categories: Object.values(union_cnt_year || {}),
                    // series: [
                    //   {
                    //         name: 'Social Content',
                    //         data: Object.values(cnt_scl_array || {})
                    //     },
                    //     {
                    //         name: 'Task',
                    //         data: Object.values(cnt_task_array || {})
                    //     },
                    //     {
                    //         name: 'Teams',
                    //         data: Object.values(cnt_team_array || {})
                    //
                    //     }
                    // ]
                    series: [
                        // {
                        //       name: 'Social Content',
                        //       data: Object.values(cnt_scl_array || {})
                        //   },
                        {
                            name: 'Twitter',
                            data: Object.values(cnt_scl1_array || {})

                        },
                        {
                            name: 'Facebook',
                            data: Object.values(cnt_scl2_array || {})

                        },
                        {
                            name: 'Instagram',
                            data: Object.values(cnt_scl3_array || {})

                        },
                        {
                            name: 'Linkedin',
                            data: Object.values(cnt_scl4_array || {})

                        },
                        {
                            name: 'Google-My-Business',
                            data: Object.values(cnt_scl5_array || {})

                        },
                        {
                            name: 'Pinterest',
                            data: Object.values(cnt_scl6_array || {})

                        },
                        {
                            name: 'Youtube',
                            data: Object.values(cnt_scl7_array || {})

                        },
                        {
                            name: 'Blogger',
                            data: Object.values(cnt_scl8_array || {})

                        },
                        {
                            name: 'Tiktok',
                            data: Object.values(cnt_scl9_array || {})

                        },
                        {
                            name: 'Task',
                            data: Object.values(cnt_task_array || {})
                        },
                        {
                            name: 'Teams',
                            data: Object.values(cnt_team_array || {})

                        }
                    ]

                };

                var options_content = {
                    chart: {
                        width: areaChartWidth,
                        height: 350,
                    },
                    series: {
                        zoomable: true,
                        showDot: true,
                        areaOpacity: 1,

                        //                  stack: {
                        //   type: 'normal'
                        // }
                    },
                    yAxis: {
                        // min:0,
                        // max:10,
                        // stepSize:1
                    },
                    xAxis: {
                        // title: 'Month'
                    },
                    tooltip: {
                        // suffix: '°C'
                        // formatter: (value) => {
                        //   const temp = Number(value.toFixed(2));
                        //   let icon = '☀️';
                        //   if (temp < 0) {
                        //     icon = '❄️';
                        //   } else if (temp > 25) {
                        //     icon = '🔥';
                        //   }
                        //
                        //   return `${icon} ${value} ℃`;
                        // },

                        //                      template: (model, defaultTooltipTemplate, theme) => {
                        //   const { body, header } = defaultTooltipTemplate;
                        //   const { background } = theme;
                        //
                        //   return `
                        //     <div style="
                        //       background: ${background};
                        //       width: 140px;
                        //       padding: 0 5px;
                        //       text-align: center;
                        //       color: white;
                        //       ">
                        //         <p>🎊 ${model.category} 🎊</p>
                        //         ${body}
                        //     </div>
                        //   `;
                        // }
                    },
                    legend: {
                        // align: "bottom",
                        // visible: false,
                        // showCheckbox: false
                    }
                };
                var theme = {
                    chart: {
                        background: {
                            color: '#fff',
                            opacity: 0
                        },
                    },
                    title: {
                        color: '#8791af',
                    },
                    xAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'
                    },
                    yAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'

                    },
                    plot: {
                        lineColor: 'rgba(166, 176, 207, 0.1)'
                    },
                    legend: {
                        label: {
                            color: '#8791af'
                        }
                    },
                    series: {
                        colors: [
                            '#34c38f', '#556ee6', '#ffc107', '#07ff40', '#d907ff', '#009688', '#8b606b', '#868b60', '#071013', '#3e5913', '#2196f3'
                        ]
                    }
                };
                // For apply theme
                tui.chart.registerTheme('myTheme', theme);
                options_content.theme = 'myTheme';
                var areaChart = tui.chart.areaChart(container_area_charts, datas_content, options_content);
            }
        }
    });
}
//new flow of Content chart end


//new flow of Portfolio chart start
var project = $('#project').val();
var content = $('#content').val();
var task = $('#task').val();
var goal = $('#goal').val();

var donutpieChartWidth = $("#donut-chart-portfolio").width(),
    container = document.getElementById("donut-chart-portfolio"),
    data = {
        // categories: ["Browser"],
        series: [{
            name: "Project",
            data: project
        }, {
            name: "Content Planner",
            data: content
        }, {
            name: "Task",
            data: task
        }, {
            name: "Goal",
            data: goal
        }]
    },
    options = {
        chart: {
            width: donutpieChartWidth,
            height: 405,
            // title: "Usage share of web browsers",
            // format: function(e, a, t, r, o) {
            //     return "makingSeriesLabel" === t && (e += "%"), e
            // }
        },
        series: {
            radiusRange: ["40%", "100%"],
            showLabel: !0
        },
        tooltip: {
            // suffix: "%"
        },
        legend: {
            align: "top"
        }
    },
    theme = {
        chart: {
            background: {
                color: "#fff",
                opacity: 0
            }
        },
        title: {
            color: "#8791af"
        },
        plot: {
            lineColor: "rgba(166, 176, 207, 0.1)"
        },
        legend: {
            label: {
                color: "#8791af"
            }
        },
        series: {
            series: {
                colors: ["#556ee6", "#34c38f", "#f46a6a", "#50a5f1"]
            },
            label: {
                color: "#fff",
                fontFamily: "sans-serif"
            }
        }
    };
tui.chart.registerTheme("myTheme", theme), options.theme = "myTheme";
var donutChart = tui.chart.pieChart(container, data, options);
$(window).resize(function() {
    donutpieChartWidth = $("#donut-chart-portfolio").width(), donutChart.resize({
        width: donutpieChartWidth,
        height: 350
    })
});
//new flow of Portfolio chart end

$(document).ready(function() {

    //new flow of individual member chart start
    var options_individual_member = {
        chart: {
            height: 350,
            type: "bar",
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "45%",
                endingShape: "rounded"
            }
        },
        dataLabels: {
            enabled: !1
        },
        stroke: {
            show: !0,
            width: 2,
            colors: ["transparent"]
        },
        series: [{
                name: 'Project',
                data: Object.values(mem_prjt_array || {})
            },
            {
                name: 'Content Planner',
                data: Object.values(mem_cnt_array || {})
            }, {
                name: 'Task',
                data: Object.values(mem_task_array || {})
            }, {
                name: 'Goal',
                data: Object.values(mem_goal_array || {})
            }, {
                name: 'Department',
                data: Object.values(mem_dep_array || {})

            }
            // , {
            //     name: 'Social Content',
            //     data: Object.values(mem_scl_array)
            // }
        ],
        colors: ["#34c38f", "#556ee6", "#f46a6a", "#c7df19", "#601a6f"],
        xaxis: {
            // categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"]
            categories: Object.values(union_mem_year || {})
        },
        grid: {
            borderColor: "#f1f1f1"
        },
        fill: {
            opacity: 1
        }
    };
    var chart_individual_member = new ApexCharts(document.querySelector("#column_chart"), options_individual_member);
    chart_individual_member.render();


    // Member Social
    memberChart();

    function memberChart() {
        $.ajax({
            url: base_url + 'front/all_Usermember',
            type: 'post',
            data: {
                portfolio_id: portfolio_id,
                user_id: selected_user
            },
            success: function(data) {

                var data = JSON.parse(data);

                var mem_pro = data.mem_pro;
                var mem_cnt = data.mem_cnt;
                var mem_tsk = data.mem_tsk;
                var mem_goal = data.mem_goal;
                var mem_dep = data.mem_dep;
                var mem_pln = data.mem_pln;

                //project
                var total_memPro = mem_pro.length;
                $('#memPro').html(total_memPro);

                var result_mprjt = mem_pro.reduce((r, {
                    pcreated_date
                }) => {
                    var key = pcreated_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                mem_prjt_data = result_mprjt;
                mem_prjt_year = Object.keys(result_mprjt);

                //content
                var total_memCnt = mem_cnt.length;
                $('#memCnt').html(total_memCnt);
                var result_mcnt = mem_cnt.reduce((r, {
                    p_publish
                }) => {
                    var key = p_publish.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                mem_cnt_data = result_mcnt;
                mem_cnt_year = Object.keys(result_mcnt);

                // task
                var total_memTask = mem_tsk.length;
                $('#memTask').html(total_memTask);

                var result_mtask = mem_tsk.reduce((r, {
                    tdue_date
                }) => {
                    var key = tdue_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                mem_task_data = result_mtask;
                mem_task_year = Object.keys(result_mtask);

                //goal
                var total_memGaol = mem_goal.length;
                $('#memGaol').html(total_memGaol);

                var result_mgoal = mem_goal.reduce((r, {
                    gstart_date
                }) => {
                    var key = gstart_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                mem_goal_data = result_mgoal;
                mem_goal_year = Object.keys(result_mgoal);

                // deaprtmet
                var total_memDep = mem_dep.length;
                $('#memDep').html(total_memDep);

                var result_mdep = mem_dep.reduce((r, {
                    createddate
                }) => {
                    var key = createddate.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                mem_dep_data = result_mdep;
                mem_dep_year = Object.keys(result_mdep);

                // social planner
                // var total_memScl = mem_pln.length;
                // $('#memScl').html(total_memScl);
                // var result_mscl = mem_pln.reduce((r, {
                //     pc_created_date
                // }) => {
                //     var key = pc_created_date.slice(0, 7);
                //     r[key] = (r[key] || 0) + 1;
                //     return r;
                // }, {});
                // mem_scl_data = result_mscl;
                // mem_scl_year = Object.keys(result_mscl);
                union_mem_year = mem_prjt_year.concat(mem_cnt_year, mem_task_year, mem_goal_year, mem_dep_year).filter(function(value, index, self) {
                    return self.indexOf(value) === index;
                });
                union_mem_year.sort();

                if (union_mem_year) {
                    var year_mem_count = union_mem_year.length;
                    if (year_mem_count) {
                        var mem_prjt_array = [];
                        for (var i = 0; i < year_mem_count; i++) {
                            if (mem_prjt_year.includes(union_mem_year[i])) {
                                var y1 = union_mem_year[i];
                                mem_prjt_array.push(mem_prjt_data[y1]);
                            } else {
                                mem_prjt_array.push(0);
                            }
                        }

                        var mem_cnt_array = [];
                        for (var j = 0; j < year_mem_count; j++) {
                            if (mem_cnt_year.includes(union_mem_year[j])) {
                                var y2 = union_mem_year[j];
                                mem_cnt_array.push(mem_cnt_data[y2]);
                            } else {
                                mem_cnt_array.push(0);
                            }
                        }

                        var mem_task_array = [];

                        for (var i = 0; i < year_mem_count; i++) {
                            if (mem_task_year.includes(union_mem_year[i])) {
                                var y1 = union_mem_year[i];
                                mem_task_array.push(mem_task_data[y1]);
                            } else {
                                mem_task_array.push(0);
                            }
                        }

                        var mem_goal_array = [];
                        for (var j = 0; j < year_mem_count; j++) {
                            if (mem_goal_year.includes(union_mem_year[j])) {
                                var y2 = union_mem_year[j];
                                mem_goal_array.push(mem_goal_data[y2]);
                            } else {
                                mem_goal_array.push(0);
                            }
                        }

                        var mem_dep_array = [];
                        for (var i = 0; i < year_mem_count; i++) {
                            if (mem_dep_year.includes(union_mem_year[i])) {
                                var y1 = union_mem_year[i];
                                mem_dep_array.push(mem_dep_data[y1]);
                            } else {
                                mem_dep_array.push(0);
                            }
                        }

                        // var mem_scl_array = [];
                        // for (var j = 0; j < year_mem_count; j++) {
                        //     if (mem_scl_year.includes(union_mem_year[j])) {
                        //         var y2 = union_mem_year[j];
                        //         mem_scl_array.push(mem_scl_data[y2]);
                        //     } else {
                        //         mem_scl_array.push(0);
                        //     }
                        // }

                    }
                }
                // }
                chart_individual_member.updateOptions({
                    chart: {
                        height: 350,
                        type: "bar",
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: !1,
                            columnWidth: "45%",
                            endingShape: "rounded"
                        }
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        show: !0,
                        width: 2,
                        colors: ["transparent"]
                    },
                    series: [{
                            name: 'Project',
                            data: Object.values(mem_prjt_array || {})
                            // data: [5, 9, 8, 1, 6, 5, 4, 5, 3, 8]
                        },
                        {
                            name: 'Content Planner',
                            data: Object.values(mem_cnt_array || {})
                            // data: [8, 3, 6, 5, 3, 5, 8, 2, 9, 6, 4, 7]
                        }, {
                            name: 'Task',
                            data: Object.values(mem_task_array || {})
                            // data: [5, 9, 8, 1, 6, 5, 4, 5, 3, 8, 7, 6]
                        }, {
                            name: 'Goal',
                            data: Object.values(mem_goal_array || {})
                            // data: [9, 4, 7, 6, 4, 5, 7, 6, 7, 2, 1, 2]
                        }, {
                            name: 'Department',
                            data: Object.values(mem_dep_array || {})
                            // data: [8, 3, 6, 5, 3, 5, 8, 2, 9, 6, 4, 7]

                        }
                        // , {
                        //     name: 'Social Content',
                        //     data: Object.values(mem_scl_array || {})
                        //     // data: [9, 4, 7, 6, 4, 5, 7, 6, 7, 2, 1, 2]
                        //
                        // }
                    ],
                    colors: ["#34c38f", "#556ee6", "#f46a6a", "#c7df19", "#601a6f"],
                    xaxis: {
                        // categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"]
                        categories: Object.values(union_mem_year)
                    },

                    grid: {
                        borderColor: "#f1f1f1"
                    },
                    fill: {
                        opacity: 1
                    }
                });
            }
        });
    }

    // $('#selected_user').on('change', function(event) {
    //     selected_user = $('#selected_user').val();
    //     $('#selected_user').attr('disabled', 'disabled');
    //     memberChart();
    //     setTimeout(function() {
    //         $('#selected_user').removeAttr('disabled');
    //
    //     }, 1000);
    //
    // });
    //new flow of individual member chart end


});

async function contentUserReport(portfolio_id, element3, daterangestart, daterangeend) {
    $.ajax({
        url: base_url + 'front/all_UserRangecontent',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            content_id: element3,
            contstart: daterangestart,
            contend: daterangeend
        },
        success: function(data) {
            var data = JSON.parse(data);
            var content_pln = data.content_daterange_pln;
            var content_task = data.content_daterange_task;
            var content_mem = data.content_daterange_mem;


            var social1 = data.user_daterange_social1;
            var social2 = data.user_daterange_social2;
            var social3 = data.user_daterange_social3;
            var social4 = data.user_daterange_social4;
            var social5 = data.user_daterange_social5;
            var social6 = data.user_daterange_social6;
            var social7 = data.user_daterange_social7;
            var social8 = data.user_daterange_social8;
            var social9 = data.user_daterange_social9;
            var content_Username = data.content_Username;


            if (data == '-1') {
                $('#cntScl').html('0');
                $('#cnttask').html('0');
                $('#cntteam').html('0');

                var areaChartWidth = $("#area-charts").width();
                var container_area_charts = document.getElementById('area-charts');
                var datas_content = {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    // categories: Object.values(union_cnt_year),
                    series: [
                        // {
                        //       name: 'Social Content',
                        //       data: [0, 0, 0, 0, 0, 0]
                        //   },
                        {
                            name: 'Task',
                            data: [0, 0, 0, 0, 0, 0]
                        },
                        {
                            name: 'Teams',
                            data: [0, 0, 0, 0, 0, 0]

                        }
                    ]
                };
                var options_content = {
                    chart: {
                        width: areaChartWidth,
                        height: 350,
                    },
                    series: {
                        zoomable: true,
                        showDot: true,
                        areaOpacity: 1
                    },
                    yAxis: {
                        // min:0,
                        // max:10,
                        // stepSize:1
                    },
                    xAxis: {
                        // title: 'Month'
                    },
                    tooltip: {
                        // suffix: '°C'
                    }
                };
                var theme = {
                    chart: {
                        background: {
                            color: '#fff',
                            opacity: 0
                        },
                    },
                    title: {
                        color: '#8791af',
                    },
                    xAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'
                    },
                    yAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'

                    },
                    plot: {
                        lineColor: 'rgba(166, 176, 207, 0.1)'
                    },
                    legend: {
                        label: {
                            color: '#8791af'
                        }
                    },
                    series: {
                        colors: [
                            '#f46a6a', '#34c38f', '#556ee6'
                        ]
                    }
                };
                // For apply theme
                tui.chart.registerTheme('myTheme', theme);
                options_content.theme = 'myTheme';
                var areaChart = tui.chart.areaChart(container_area_charts, datas_content, options_content);
            } else if (data) {

                // var total_cntScl = content_pln.length;
                // $('#cntScl').html(total_cntScl);

                var total_cnttask = content_task.length;
                $('#cnttask').html(total_cnttask);

                var total_cntteam = content_mem.length;
                $('#cntteam').html(total_cntteam);
                //social planner
                // var result_social = content_pln.reduce((r, {
                //     pc_created_date
                // }) => {
                //     var key = pc_created_date.slice(0, 7);
                //     r[key] = (r[key] || 0) + 1;
                //     return r;
                // }, {});
                // cnt_scl_data = result_social;
                // cnt_scl_year = Object.keys(result_social);


                var result_social1 = social1.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social1 = result_social1;
                cnt_social1_year = Object.keys(result_social1);

                var result_social2 = social2.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social2 = result_social2;
                cnt_social2_year = Object.keys(result_social2);


                var result_social3 = social3.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social3 = result_social3;
                cnt_social3_year = Object.keys(result_social3);

                var result_social4 = social4.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social4 = result_social4;
                cnt_social4_year = Object.keys(result_social4);

                var result_social5 = social5.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social5 = result_social5;
                cnt_social5_year = Object.keys(result_social5);

                var result_social6 = social6.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social6 = result_social6;
                cnt_social6_year = Object.keys(result_social6);

                var result_social7 = social7.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social7 = result_social7;
                cnt_social7_year = Object.keys(result_social7);


                var result_social8 = social8.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social8 = result_social8;
                cnt_social8_year = Object.keys(result_social8);

                var result_social9 = social9.reduce((r, {
                    pc_created_date
                }) => {
                    var key = pc_created_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_social9 = result_social9;
                cnt_social9_year = Object.keys(result_social9);

                //task
                var result_task = content_task.reduce((r, {
                    tdue_date
                }) => {
                    var key = tdue_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_task_data = result_task;
                cnt_task_year = Object.keys(result_task);

                //team
                var result_task = content_mem.reduce((r, {
                    sent_date
                }) => {
                    var key = sent_date.slice(0, 7);
                    r[key] = (r[key] || 0) + 1;
                    return r;
                }, {});
                cnt_team_data = result_task;
                cnt_team_year = Object.keys(result_task);
                // console.log(cnt_team_data);
                if (cnt_task_year || cnt_team_year) {
                    union_cnt_year = cnt_task_year.concat(cnt_social1_year, cnt_social2_year, cnt_social3_year, cnt_social4_year, cnt_social5_year, cnt_social6_year, cnt_social7_year, cnt_social8_year, cnt_social9_year, cnt_team_year).filter(function(value, index, self) {
                        return self.indexOf(value) === index;
                    });
                    union_cnt_year.sort();
                    if (union_cnt_year) {
                        var year_cnt_count = union_cnt_year.length;
                        if (year_cnt_count) {
                            // var cnt_scl_array = [];
                            // for (var i = 0; i < year_cnt_count; i++) {
                            //     if (cnt_scl_year.includes(union_cnt_year[i])) {
                            //         var y1 = union_cnt_year[i];
                            //         cnt_scl_array.push(cnt_scl_data[y1]);
                            //     } else {
                            //         cnt_scl_array.push(0);
                            //     }
                            // }

                            var cnt_scl1_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social1_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl1_array.push(cnt_social1[y1]);
                                } else {
                                    cnt_scl1_array.push(0);
                                }
                            }

                            var cnt_scl2_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social2_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl2_array.push(cnt_social2[y1]);
                                } else {
                                    cnt_scl2_array.push(0);
                                }
                            }

                            var cnt_scl3_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social3_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl3_array.push(cnt_social3[y1]);
                                } else {
                                    cnt_scl3_array.push(0);
                                }
                            }

                            var cnt_scl4_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social4_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl4_array.push(cnt_social4[y1]);
                                } else {
                                    cnt_scl4_array.push(0);
                                }
                            }

                            var cnt_scl5_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social5_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl5_array.push(cnt_social5[y1]);
                                } else {
                                    cnt_scl5_array.push(0);
                                }
                            }

                            var cnt_scl6_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social6_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl6_array.push(cnt_social6[y1]);
                                } else {
                                    cnt_scl6_array.push(0);
                                }
                            }


                            var cnt_scl7_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social7_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl7_array.push(cnt_social7[y1]);
                                } else {
                                    cnt_scl7_array.push(0);
                                }
                            }

                            var cnt_scl8_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social8_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl8_array.push(cnt_social8[y1]);
                                } else {
                                    cnt_scl8_array.push(0);
                                }
                            }

                            var cnt_scl9_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_social9_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_scl9_array.push(cnt_social9[y1]);
                                } else {
                                    cnt_scl9_array.push(0);
                                }
                            }

                            var cnt_task_array = [];
                            for (var j = 0; j < year_cnt_count; j++) {
                                if (cnt_task_year.includes(union_cnt_year[j])) {
                                    var y2 = union_cnt_year[j];
                                    cnt_task_array.push(cnt_task_data[y2]);
                                } else {
                                    cnt_task_array.push(0);
                                }
                            }
                            var cnt_team_array = [];
                            for (var i = 0; i < year_cnt_count; i++) {
                                if (cnt_team_year.includes(union_cnt_year[i])) {
                                    var y1 = union_cnt_year[i];
                                    cnt_team_array.push(cnt_team_data[y1]);
                                } else {
                                    cnt_team_array.push(0);
                                }
                            }
                        }
                    }
                }
                var areaChartWidth = $("#view_cnt_chart").width();
                var container_area_charts = document.getElementById('view_cnt_chart');
                var datas_content = {
                    // categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    categories: Object.values(union_cnt_year || {}),
                    // series: [
                    //   {
                    //         name: 'Social Content',
                    //         data: Object.values(cnt_scl_array || {})
                    //     },
                    //     {
                    //         name: 'Task',
                    //         data: Object.values(cnt_task_array || {})
                    //     },
                    //     {
                    //         name: 'Teams',
                    //         data: Object.values(cnt_team_array || {})
                    //
                    //     }
                    // ]
                    series: [
                        // {
                        //       name: 'Social Content',
                        //       data: Object.values(cnt_scl_array || {})
                        //   },
                        {
                            name: 'Twitter',
                            data: Object.values(cnt_scl1_array || {})

                        },
                        {
                            name: 'Facebook',
                            data: Object.values(cnt_scl2_array || {})

                        },
                        {
                            name: 'Instagram',
                            data: Object.values(cnt_scl3_array || {})

                        },
                        {
                            name: 'Linkedin',
                            data: Object.values(cnt_scl4_array || {})

                        },
                        {
                            name: 'Google-My-Business',
                            data: Object.values(cnt_scl5_array || {})

                        },
                        {
                            name: 'Pinterest',
                            data: Object.values(cnt_scl6_array || {})

                        },
                        {
                            name: 'Youtube',
                            data: Object.values(cnt_scl7_array || {})

                        },
                        {
                            name: 'Blogger',
                            data: Object.values(cnt_scl8_array || {})

                        },
                        {
                            name: 'Tiktok',
                            data: Object.values(cnt_scl9_array || {})

                        },
                        {
                            name: 'Task',
                            data: Object.values(cnt_task_array || {})
                        },
                        {
                            name: 'Teams',
                            data: Object.values(cnt_team_array || {})

                        }
                    ]

                };

                var options_content = {
                    chart: {
                        width: areaChartWidth,
                        height: 350,
                    },
                    series: {
                        zoomable: true,
                        showDot: true,
                        areaOpacity: 1,

                        //                  stack: {
                        //   type: 'normal'
                        // }
                    },
                    yAxis: {
                        // min:0,
                        // max:10,
                        // stepSize:1
                    },
                    xAxis: {
                        // title: 'Month'
                    },
                    tooltip: {
                        // suffix: '°C'
                        // formatter: (value) => {
                        //   const temp = Number(value.toFixed(2));
                        //   let icon = '☀️';
                        //   if (temp < 0) {
                        //     icon = '❄️';
                        //   } else if (temp > 25) {
                        //     icon = '🔥';
                        //   }
                        //
                        //   return `${icon} ${value} ℃`;
                        // },

                        //                      template: (model, defaultTooltipTemplate, theme) => {
                        //   const { body, header } = defaultTooltipTemplate;
                        //   const { background } = theme;
                        //
                        //   return `
                        //     <div style="
                        //       background: ${background};
                        //       width: 140px;
                        //       padding: 0 5px;
                        //       text-align: center;
                        //       color: white;
                        //       ">
                        //         <p>🎊 ${model.category} 🎊</p>
                        //         ${body}
                        //     </div>
                        //   `;
                        // }
                    },
                    legend: {
                        // align: "bottom",
                        // visible: false,
                        // showCheckbox: false
                    }
                };
                var theme = {
                    chart: {
                        background: {
                            color: '#fff',
                            opacity: 0
                        },
                    },
                    title: {
                        color: '#8791af',
                    },
                    xAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'
                    },
                    yAxis: {
                        title: {
                            color: '#8791af'
                        },
                        label: {
                            color: '#8791af'
                        },
                        tickColor: '#8791af'

                    },
                    plot: {
                        lineColor: 'rgba(166, 176, 207, 0.1)'
                    },
                    legend: {
                        label: {
                            color: '#8791af'
                        }
                    },
                    series: {
                        colors: [
                            '#34c38f', '#556ee6', '#ffc107', '#07ff40', '#d907ff', '#009688', '#8b606b', '#868b60', '#071013', '#3e5913', '#2196f3'
                        ]
                    }
                };
                // For apply theme
                tui.chart.registerTheme('myTheme', theme);
                options_content.theme = 'myTheme';
                var areaChart = tui.chart.areaChart(container_area_charts, datas_content, options_content);
                var tooltipContainer = document.querySelectorAll('#view_cnt_chart .tui-area-chart');
                for (var i = 0; i < tooltipContainer.length; i++) {
                    // tooltipContainer[i].classList.add("my-chart-"+start+"");
                    tooltipContainer[i].setAttribute('id', 'my-chart-' + i);
                }
                var cntIDs = $("#view_cnt_chart").children().map(function() {
                    return this.id;
                }).get();
                // Content
                for (var z = (cntIDs.length - 1); z < cntIDs.length; z++) {
                    var tooltipcontent = document.getElementById(cntIDs[z]);


                    return new Promise((resolve) => {
                        // Do some async work
                        setTimeout(() => {
                            // const chartElement = document.querySelector("#" + childIDs[z]);
                            html2canvas(tooltipcontent).then(canvas => {
                                // use the canvas to create a PNG image
                                document.body.appendChild(canvas)
                                const pngcontent = canvas.toDataURL('image/png');
                                dataArray.push(pngcontent);
                                myArray.push('Content');
                                selectedChartCat.push(content_Username);

                            });
                            resolve(1 + 1);
                        }, 3000);
                    });

                }
            }
        }
    });
}
async function projectUserReport(portfolio_id, element2, daterangestart, daterangeend) {
    $.ajax({
        url: base_url + 'front/all_UserRangeproject',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            project_id: element2,
            prjtstart: daterangestart,
            prjtend: daterangeend
        },
        success: function(data) {
            var data = JSON.parse(data);

            var one = data.pro_task_user;
            var two = data.pro_member_user;
            var three = data.prjt_user_name;

            const total = one.length;
            $('#protask').html(total);

            var dt = two.length;
            $('#proteam').html(dt);

            //task
            var result = one.reduce((r, {
                tdue_date
            }) => {
                var key = tdue_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            task_data = result;
            task_year = Object.keys(result);

            //team
            var result_team = two.reduce((r, {
                sent_date
            }) => {
                var key = sent_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            team_data = result_team;
            team_year = Object.keys(result_team);

            if (task_year || team_year) {
                union_year = task_year.concat(team_year).filter(function(value, index, self) {
                    return self.indexOf(value) === index;
                });
                union_year.sort();

                if (union_year) {
                    var year_count = union_year.length;
                    if (year_count) {
                        var team_array = [];
                        for (var i = 0; i < year_count; i++) {
                            if (team_year.includes(union_year[i])) {
                                var y1 = union_year[i];
                                team_array.push(team_data[y1]);
                            } else {
                                team_array.push(0);
                            }
                        }

                        var task_array = [];
                        for (var j = 0; j < year_count; j++) {
                            if (task_year.includes(union_year[j])) {
                                var y2 = union_year[j];
                                task_array.push(task_data[y2]);
                            } else {
                                task_array.push(0);
                            }
                        }
                    }
                }
            }
            var chart_project = new ApexCharts(document.querySelector('#view_prjt_chart'), {
                series: [{
                        name: 'Task',
                        data: Object.values(task_array || {})
                    },
                    {
                        name: 'Team Member',
                        data: Object.values(team_array || {})
                    }
                ],
                chart: {
                    height: 350,
                    type: "area",
                    toolbar: {
                        show: !1
                    }
                },
                xaxis: {
                    categories: Object.values(union_year || {}),
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [1]
                },

            });

            chart_project.render().then(() => {



                var prjtIDS = $("#view_prjt_chart").children().map(function() {
                    return this.id;
                }).get();
                for (var z = (prjtIDS.length - 1); z < prjtIDS.length; z++) {
                    var tooltipprjt = document.getElementById(prjtIDS[z]);
                    return new Promise((resolve) => {
                        // Do some async work
                        setTimeout(() => {

                            // const chartElement = document.querySelector("#" + childIDs[z]);
                            html2canvas(tooltipprjt).then(canvas => {
                                // use the canvas to create a PNG image
                                document.body.appendChild(canvas)
                                const pngprjt = canvas.toDataURL('image/png');
                                dataArray.push(pngprjt)
                                myArray.push('Project');
                                selectedChartCat.push(three);

                            });
                            resolve(1 + 1);
                        }, 1000);
                    });

                }
            })

        }
    });
}

async function departmentUserReport(portfolio_id, element4, daterangestart, daterangeend) {
    $.ajax({
        url: base_url + 'front/all_UserRangedepartment',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            department_id: element4,
            deptstart: daterangestart,
            deptend: daterangeend
        },
        success: function(data) {

            var data = JSON.parse(data);

            var dep_project = data.dep_userrangepro;
            var dep_content = data.dep_userrangecnt;
            var dep_task = data.dep_userrangetask;
            var dep_goal = data.dep_userrangegoal;
            var dep_usernmae = data.dep_username;

            // deaprtmet project
            var total_depPro = dep_project.length;
            $('#depPro').html(total_depPro);
            var result_prjt = dep_project.reduce((r, {
                pcreated_date
            }) => {
                var key = pcreated_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_prjt_data = result_prjt;
            dep_prjt_year = Object.keys(result_prjt);

            // deaprtmet conetnt
            var total_depCnt = dep_content.length;
            $('#depCnt').html(total_depCnt);

            var result_dcnt = dep_content.reduce((r, {
                p_publish
            }) => {
                var key = p_publish.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_cnt_data = result_dcnt;
            dep_cnt_year = Object.keys(result_dcnt);

            // deaprtmet task
            var total_depTask = dep_task.length;
            $('#depTask').html(total_depTask);
            var result_dtask = dep_task.reduce((r, {
                tdue_date
            }) => {
                var key = tdue_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_task_data = result_dtask;
            dep_task_year = Object.keys(result_dtask);

            // deaprtmet goal
            var total_depGaol = dep_goal.length;
            $('#depGaol').html(total_depGaol);
            var result_dgoal = dep_goal.reduce((r, {
                gstart_date
            }) => {
                var key = gstart_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            dep_goal_data = result_dgoal;
            dep_goal_year = Object.keys(result_dgoal);

            if (dep_prjt_year || dep_cnt_year || dep_task_year || dep_goal_year) {
                var union_dep_year = dep_prjt_year.concat(dep_cnt_year, dep_task_year, dep_goal_year).filter(function(value, index, self) {
                    return self.indexOf(value) === index;
                });
                union_dep_year.sort();
                if (union_dep_year) {
                    var year_dep_count = union_dep_year.length;
                    if (year_dep_count) {
                        var dep_prjt_array = [];
                        for (var i = 0; i < year_dep_count; i++) {
                            if (dep_prjt_year.includes(union_dep_year[i])) {
                                var y1 = union_dep_year[i];
                                dep_prjt_array.push(dep_prjt_data[y1]);
                            } else {
                                dep_prjt_array.push(0);
                            }
                        }
                        var dep_cnt_array = [];
                        for (var j = 0; j < year_dep_count; j++) {
                            if (dep_cnt_year.includes(union_dep_year[j])) {
                                var y2 = union_dep_year[j];
                                dep_cnt_array.push(dep_cnt_data[y2]);
                            } else {
                                dep_cnt_array.push(0);
                            }
                        }
                        var dep_task_array = [];
                        for (var i = 0; i < year_dep_count; i++) {
                            if (dep_task_year.includes(union_dep_year[i])) {
                                var y1 = union_dep_year[i];
                                dep_task_array.push(dep_task_data[y1]);
                            } else {
                                dep_task_array.push(0);
                            }
                        }
                        var dep_goal_array = [];
                        for (var j = 0; j < year_dep_count; j++) {
                            if (dep_goal_year.includes(union_dep_year[j])) {
                                var y2 = union_dep_year[j];
                                dep_goal_array.push(dep_goal_data[y2]);
                            } else {
                                dep_goal_array.push(0);
                            }
                        }
                    }
                }
            }
            const chart_department = new ApexCharts(document.querySelector('#view_dept_chart'), {
                chart: {
                    height: 350,
                    type: "line",
                    stacked: !1,
                    toolbar: {
                        show: !1
                    }
                },
                stroke: {
                    width: [0, 2, 4],
                    curve: "smooth"
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%"
                    }
                },
                colors: ["#f46a6a", "#556ee6", "#34c38f", "#c7df19"],
                series: [{
                    name: "Project",
                    type: "column",
                    data: Object.values(dep_prjt_array || {})

                }, {
                    name: "Content Planner",
                    type: "area",
                    data: Object.values(dep_cnt_array || {})
                }, {
                    name: "Task",
                    type: "line",
                    data: Object.values(dep_task_array || {})

                }, {
                    name: "Goal",
                    type: "bar",
                    data: Object.values(dep_goal_array || {})

                }],
                fill: {
                    opacity: [.85, .25, 1],
                    gradient: {
                        inverseColors: !1,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: .85,
                        opacityTo: .55,
                        stops: [0, 100, 100, 100]
                    }
                },
                labels: Object.values(union_dep_year || {}),
                markers: {
                    size: 0
                },
                xaxis: {},
                yaxis: {
                    title: {
                        // text: "Points"
                    },
                },
                tooltip: {
                    shared: !0,
                    intersect: !1,
                    y: {
                        formatter: function(e) {
                            return void 0 !== e ? e.toFixed(0) + " points" : e
                        }
                    }
                },
                grid: {
                    borderColor: "#f1f1f1"
                }
            });
            chart_department.render().then(() => {




                var childIDs = $("#view_dept_chart").children().map(function() {
                    return this.id;
                }).get();
                // Member




                for (var z = (childIDs.length - 1); z < childIDs.length; z++) {
                    var tooltipteam = document.getElementById(childIDs[z]);


                    return new Promise((resolve) => {
                        // Do some async work
                        setTimeout(() => {

                            // const chartElement = document.querySelector("#" + childIDs[z]);
                            html2canvas(tooltipteam).then(canvas => {
                                // use the canvas to create a PNG image
                                document.body.appendChild(canvas)
                                const pngImage = canvas.toDataURL('image/png');
                                dataArray.push(pngImage)


                                myArray.push('Department');
                                selectedChartCat.push(dep_usernmae);

                            });
                            resolve(1 + 1);
                        }, 1000);
                    });

                }




            })
        }
    });
}
async function goalUserReport(portfolio_id, element, daterangestart, daterangeend) {
    $.ajax({
        url: base_url + 'front/all_UserRangegoal',
        type: 'post',
        data: {
            portfolio_id: portfolio_id,
            goal_id: element,
            goalstart: daterangestart,
            goalend: daterangeend

        },
        success: function(data) {

            var data = JSON.parse(data);

            var goal_kpi = data.goal_userkpi;
            var goal_pro = data.goal_userpro;
            var goal_cnt = data.goal_usercnt;
            var goal_task = data.goal_usertask;
            var goal_username = data.goal_username;

            //kpi
            var total_gaolKPI = goal_kpi.length;
            $('#gaolKPI').html(total_gaolKPI);

            var result_glkpi = goal_kpi.reduce((r, {
                screated_date
            }) => {
                var key = screated_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            goal_kpi_data = result_glkpi;
            goal_kpi_year = Object.keys(result_glkpi);

            //project
            var total_goalPro = goal_pro.length;
            $('#goalPro').html(total_goalPro);
            var result_glprjt = goal_pro.reduce((r, {
                pcreated_date
            }) => {
                var key = pcreated_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            goal_project_data = result_glprjt;
            goal_project_year = Object.keys(result_glprjt);

            // content
            var total_goalCnt = goal_cnt.length;
            $('#goalCnt').html(total_goalCnt);

            var result_glcnt = goal_cnt.reduce((r, {
                p_publish
            }) => {
                var key = p_publish.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            goal_content_data = result_glcnt;
            goal_content_year = Object.keys(result_glcnt);

            // task
            var total_goalTask = goal_task.length;
            $('#goalTask').html(total_goalTask);

            var result_gltask = goal_task.reduce((r, {
                tdue_date
            }) => {
                var key = tdue_date.slice(0, 7);
                r[key] = (r[key] || 0) + 1;
                return r;
            }, {});
            goal_task_data = result_gltask;
            goal_task_year = Object.keys(result_gltask);
            if (goal_kpi_year || goal_project_year || goal_content_year || goal_task_year) {
                union_goal_year = goal_kpi_year.concat(goal_project_year, goal_content_year, goal_task_year).filter(function(value, index, self) {
                    return self.indexOf(value) === index;
                });
                union_goal_year.sort();
                if (union_goal_year) {
                    var year_goal_count = union_goal_year.length;
                    if (year_goal_count) {
                        var goal_kpi_array = [];
                        for (var i = 0; i < year_goal_count; i++) {
                            if (goal_kpi_year.includes(union_goal_year[i])) {
                                var y1 = union_goal_year[i];
                                goal_kpi_array.push(goal_kpi_data[y1]);
                            } else {
                                goal_kpi_array.push(0);
                            }
                        }
                        var goal_project_array = [];
                        for (var j = 0; j < year_goal_count; j++) {
                            if (goal_project_year.includes(union_goal_year[j])) {
                                var y2 = union_goal_year[j];
                                goal_project_array.push(goal_project_data[y2]);
                            } else {
                                goal_project_array.push(0);
                            }
                        }

                        var goal_content_array = [];
                        for (var i = 0; i < year_goal_count; i++) {
                            if (goal_content_year.includes(union_goal_year[i])) {
                                var y1 = union_goal_year[i];
                                goal_content_array.push(goal_content_data[y1]);
                            } else {
                                goal_content_array.push(0);
                            }
                        }
                        var goal_task_array = [];
                        for (var j = 0; j < year_goal_count; j++) {
                            if (goal_task_year.includes(union_goal_year[j])) {
                                var y2 = union_goal_year[j];
                                goal_task_array.push(goal_task_data[y2]);
                            } else {
                                goal_task_array.push(0);
                            }
                        }
                    }
                }
            }
            var options_goal = {
                    chart: {
                        height: 350,
                        type: "line",
                        zoom: {
                            enabled: !1
                        },
                        toolbar: {
                            show: !1
                        }
                    },
                    colors: ["#556ee6", "#34c38f", "#963e3e", "#8a963e"],
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        width: [3, 3],
                        curve: "straight"
                    },
                    series: [{
                        name: "KPI's",
                        data: Object.values(goal_kpi_array || {})
                    }, {
                        name: 'Project',
                        data: Object.values(goal_project_array || {})
                    }, {
                        name: 'Content Project',
                        data: Object.values(goal_content_array || {})
                    }, {
                        name: 'Task',
                        data: Object.values(goal_task_array || {})
                    }],
                    title: {
                        // text: "Average High & Low Temperature",
                        align: "left",
                        style: {
                            fontWeight: "500"
                        }
                    },
                    grid: {
                        row: {
                            colors: ["transparent", "transparent"],
                            opacity: .2
                        },
                        borderColor: "#f1f1f1"
                    },
                    markers: {
                        style: "inverted",
                        size: 6
                    },
                    xaxis: {
                        categories: Object.values(union_goal_year || {}),
                    },
                    yaxis: {
                        title: {
                            text: ""
                        },
                    },
                    legend: {
                        position: "top",
                        horizontalAlign: "right",
                        floating: !0,
                        offsetY: -25,
                        offsetX: -5
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                toolbar: {
                                    show: !1
                                }
                            },
                            legend: {
                                show: !1
                            }
                        }
                    }]
                },
                chart_goal = new ApexCharts(document.querySelector("#view_goal_chart"), options_goal);
            chart_goal.render().then(() => {

                var goalchild = $("#view_goal_chart").children().map(function() {
                    return this.id;
                }).get();
                for (var z = (goalchild.length - 1); z < goalchild.length; z++) {
                    var tooltipgoal = document.getElementById(goalchild[z]);

                    return new Promise((resolve) => {
                        // Do some async work
                        setTimeout(() => {

                            // const chartElement = document.querySelector("#" + childIDs[z]);
                            html2canvas(tooltipgoal).then(canvas => {
                                // use the canvas to create a PNG image
                                document.body.appendChild(canvas)
                                const pnggoal = canvas.toDataURL('image/png');
                                dataArray.push(pnggoal)
                                myArray.push('Goal');
                                selectedChartCat.push(goal_username);

                            });
                            resolve(1 + 1);
                        }, 1000);
                    });

                }
            })
        }
    });
}
var dataArray = [];
var myArray = [];
var selectedChartCat = [];

$('#portfolio_team').change(function() { //change click to hidden
    //  if ($(this).is(':checked')) { //check if checkbox is checked
    //      $('#chkteam').show(); //show if checked
    //  } else {
    //      $('#chkteam').hide(); //hide if unchecked
    //      document.getElementById('showTeam').style.display = 'none';
    //      $('#teamone').prop('checked', true);
    //    //   $('#teamtwo').prop('checked', false);
    //  }
    if ($('#portfolio_team').is(':checked')) { //check if checkbox is checked
        $('#showTeam').show(); //show if checked
        $('#dateRow').show();
    } else {
        $('#showTeam').hide(); //show if checked
        //   $('#dateRow').hide();
    }
});
// function showteam() {
//     if ($('#teamtwo').is(':checked')) { //check if checkbox is checked
//         $('#showTeam').show(); //show if checked
//     } else {
//         $('#showTeam').hide(); //show if checked
//     }
// }

function selected_team() {
    var selected = [];
    for (var option of document.getElementById('sel_team').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }

    document.getElementById("selected_multi_team").value = selected;
}


$('#portfolio_dept').change(function() { //change click to hidden

    //  if ($(this).is(':checked')) { //check if checkbox is checked
    //      $('#chkdepartment').show(); //show if checked
    //  } else {
    //      $('#chkdepartment').hide(); //hide if unchecked
    //      document.getElementById('showDept').style.display = 'none';
    //      $('#deptone').prop('checked', true);
    //  }
    if ($('#portfolio_dept').is(':checked')) { //check if checkbox is checked
        $('#showDept').show(); //show if checked
        $('#dateRow').show();
    } else {
        $('#showDept').hide(); //show if checked
        //   $('#dateRow').hide();
    }
});

// function showdept() {
//     if ($('#depttwo').is(':checked')) { //check if checkbox is checked
//         $('#showDept').show(); //show if checked
//     } else {
//         $('#showDept').hide(); //show if checked
//     }
// }

function selected_dept() {
    var selected = [];
    for (var option of document.getElementById('sel_dept').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }

    document.getElementById("selected_multi_dept").value = selected;
}


$('#portfolio_cnt').change(function() { //change click to hidden
    //  if ($(this).is(':checked')) { //check if checkbox is checked
    //      $('#chkcontent').show(); //show if checked
    //  } else {
    //      $('#chkcontent').hide(); //hide if unchecked
    //      document.getElementById('showContent').style.display = 'none';
    //      $('#cntone').prop('checked', true);
    //  }
    if ($('#portfolio_cnt').is(':checked')) { //check if checkbox is checked
        $('#showContent').show(); //show if checked
        $('#dateRow').show();
    } else {
        $('#showContent').hide(); //show if checked
        //   $('#dateRow').hide();
    }
});

// function showcontent() {
//     if ($('#cnttwo').is(':checked')) { //check if checkbox is checked
//         $('#showContent').show(); //show if checked
//     } else {
//         $('#showContent').hide(); //show if checked
//     }
// }

function selected_cnt() {
    var selected = [];
    for (var option of document.getElementById('sel_cnt').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    document.getElementById("selected_multi_cnt").value = selected;
}

$('#portfolio_pjt').change(function() { //change click to hidden
    //  if ($(this).is(':checked')) { //check if checkbox is checked
    //      $('#chkproject').show(); //show if checked
    //  } else {
    //      $('#chkproject').hide(); //hide if unchecked
    //      document.getElementById('showProject').style.display = 'none';
    //      $('#prjtone').prop('checked', true);
    //  }
    if ($('#portfolio_pjt').is(':checked')) { //check if checkbox is checked
        $('#showProject').show(); //show if checked
        $('#dateRow').show();
    } else {
        $('#showProject').hide(); //show if checked
        //   $('#dateRow').hide();
    }
});

// function showproject() {
//     if ($('#prjttwo').is(':checked')) { //check if checkbox is checked
//         $('#showProject').show(); //show if checked
//     } else {
//         $('#showProject').hide(); //show if checked
//     }
// }

function selected_prjt() {
    var selected = [];
    for (var option of document.getElementById('sel_prjt').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    document.getElementById("selected_multi_prjt").value = selected;
}

$('#portfolio_glstr').change(function() { //change click to hidden
    //  if ($(this).is(':checked')) { //check if checkbox is checked
    //      $('#chkgoal').show(); //show if checked
    //  } else {
    //      $('#chkgoal').hide(); //hide if unchecked
    //      document.getElementById('showGoal').style.display = 'none';
    //      $('#igotone').prop('checked', true);
    //  }
    if ($('#portfolio_glstr').is(':checked')) { //check if checkbox is checked
        $('#showGoal').show(); //show if checked
        $('#dateRow').show();
    } else {
        $('#showGoal').hide(); //show if checked
        //   $('#dateRow').hide();
    }
});

// function showgoal() {
//     if ($('#igottwo').is(':checked')) { //check if checkbox is checked
//         $('#showGoal').show(); //show if checked
//     } else {
//         $('#showGoal').hide(); //show if checked
//     }
// }

function selected_goals() {
    var selected = [];
    for (var option of document.getElementById('sel_gl').options) {
        if (option.selected) {
            selected.push(option.value);
        }
    }
    document.getElementById("selected_multi_gl").value = selected;
}

var checkbox = document.getElementById('summary');
var checkboxes2 = document.getElementsByClassName("checkbox");
// // var checkboxes_new = document.getElementsByClassName("checkbox");
// // var checkboxes = document.querySelectorAll('input[type="checkbox"]');

checkbox.addEventListener('change', function() {
    if (this.checked) {
        checkboxes2.forEach(function(checkbox) {
            checkbox.disabled = true;
        });
    } else {
        checkboxes2.forEach(function(checkbox) {
            checkbox.disabled = false;
        });
    }
});


// $(".checkbox").change(function() {
//    alert();
//     let isChecked = $('.checkbox').is(':checked');
//     console.log(isChecked);
//     if (isChecked) {
//    alert('1');

//         $("#summary").attr("disabled", true);
//     } else {
//    alert('2');

//         $("#summary").attr("disabled", false);
//     }
// });

// const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const checkboxes = document.getElementsByClassName('checkbox');
let numChecked = 0;

checkboxes.forEach((checkbox, index) => {
    checkbox.addEventListener('change', () => {
        //  if (index === 0 && checkbox.checked) {
        //    alert('new');

        //    checkboxes.forEach((cb, i) => {
        //      if (i !== 0) {
        //        cb.disabled = false;

        //      }
        //    });

        //  } else {

        if (checkbox.checked) {
            numChecked++;
            $("#summary").attr("disabled", true);
        } else {
            numChecked--;

        }

        if (numChecked === 2) {
            checkboxes.forEach((cb) => {
                if (!cb.checked) {
                    cb.disabled = true;
                }
            });
        } else if (numChecked === 0) {
            $("#summary").attr("disabled", false);
        } else {
            checkboxes.forEach((cb) => {
                cb.disabled = false;
            });
        }
        //  }
    });
});

$(document).ready(function() {
    var portfolio_id = $('#portfolio_id').val();


    $('#download_pdf').click(function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let checkedCount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        if (checkedCount > 0) {
            var hide = $('#hide_pdf').val('1');
            generateData(hide);
        } else {
            $('#templateErr').text('Please check atleast one  checkbox!');
        }
    });

    $('#download_ppt').click(function() {

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let checkedCount = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });

        if (checkedCount > 0) {
            var hide = $('#hide_ppt').val('1');
            generateData(hide);
        } else {
            $('#templateErr').text('Please check atleast one  checkbox!');
        }
    });
});

function generateData(hide) {
    var template = $('#report_name').val();
    $.ajax({
        url: base_url + 'front/checkUserTemplate',
        type: 'post',
        data: {
            template: template
        },
        success: function(data) {
            if (data.status == false) {
                //show errors
                $('[id*=Err]').html('');
                $.each(data.errors, function(key, val) {
                    var key = key.replace(/\[]/g, '');
                    key = key + 'Err';
                    $('#' + key).html(val);
                })
            } else if (data.status == true) {

                var daterangestart = $('input[name="daterangestart"]').val();
                var daterangeend = $('input[name="daterangeend"]').val();

                document.getElementById("download_pdf").disabled = true;
                document.getElementById("download_ppt").disabled = true;
                $('#loaderModal').modal('show');
                $('#exampleModal').modal('hide');
                var selectedFruits = [];
                $('input[name="progress"]:checked').each(function() {
                    selectedFruits.push($(this).val());
                });
                var name = selectedFruits.join(', ');
                const myoldArray = name.split(" ");
                (async function() {

                    for (var i = 0; i < myoldArray.length; i++) {

                        var newStr = myoldArray[i].replace(',', '')


                        if (newStr === 'summary') {
                            //portfolio
                            var chartElements = document.querySelector('#donut-chart-portfolio');
                            html2canvas(chartElements).then(donut => {
                                // use the canvas to create a PNG image
                                document.body.appendChild(donut)
                                const donutImage = donut.toDataURL('image/png');
                                dataArray.push(donutImage);

                                myArray.push('Portfolio');
                                selectedChartCat.push(' ');

                                // department
                                var dep_vals = document.getElementById("selected_depart");
                                var selectedIndexDep = dep_vals.selectedIndex;
                                if (selectedIndexDep !== -1) {
                                    var selectedOption = dep_vals.options[selectedIndexDep];
                                    var selectedText = selectedOption.text;
                                    var dep_val = selectedText;
                                } else {
                                    var dep_val = '';
                                }
                                var chartElement2 = document.querySelector('#mixed_chart');
                                html2canvas(chartElement2).then(dt => {
                                    // use the canvas to create a PNG image
                                    document.body.appendChild(dt)
                                    const dtImage = dt.toDataURL('image/png');
                                    dataArray.push(dtImage);

                                    selectedChartCat.push(dep_val);
                                    myArray.push('Department');


                                    // Member
                                    var chartElement3 = document.querySelector('#column_chart');
                                    html2canvas(chartElement3).then(mt => {
                                        // use the canvas to create a PNG image
                                        document.body.appendChild(mt)
                                        const mtImage = mt.toDataURL('image/png');
                                        dataArray.push(mtImage);

                                        myArray.push('My Work');
                                        selectedChartCat.push('');


                                        // Goals
                                        var goal_vals = document.getElementById("selected_goal");

                                        var selectedIndexGoal = goal_vals.selectedIndex;
                                        if (selectedIndexGoal !== -1) {
                                            var selectedOptiongl = goal_vals.options[selectedIndexGoal];
                                            var selectedTextgl = selectedOptiongl.text;
                                            var goal_val = selectedTextgl;
                                        } else {
                                            var goal_val = '';
                                        }

                                        var chartElement4 = document.querySelector('#line_chart_datalabel');
                                        html2canvas(chartElement4).then(gt => {
                                            // use the canvas to create a PNG image
                                            document.body.appendChild(gt)
                                            const gtImage = gt.toDataURL('image/png');
                                            dataArray.push(gtImage);

                                            myArray.push('Goal');
                                            selectedChartCat.push(goal_val);


                                            // Content
                                            var cnt_vals = document.getElementById("selected_content");
                                            var selectedIndexCnt = cnt_vals.selectedIndex;
                                            if (selectedIndexCnt !== -1) {
                                                var selectedOptionCt = cnt_vals.options[selectedIndexCnt];
                                                var selectedTextCt = selectedOptionCt.text;
                                                var cnt_val = selectedTextCt;
                                            } else {
                                                var cnt_val = '';
                                            }

                                            var chartElement5 = document.querySelector('#area-charts');
                                            html2canvas(chartElement5).then(ct => {
                                                // use the canvas to create a PNG image
                                                document.body.appendChild(ct)
                                                const ctImage = ct.toDataURL('image/png');
                                                dataArray.push(ctImage);

                                                myArray.push('Content');
                                                selectedChartCat.push(cnt_val);


                                                //project
                                                var prjt_vals = document.getElementById("selected_project");

                                                var selectedIndexPrjt = prjt_vals.selectedIndex;
                                                if (selectedIndexPrjt !== -1) {
                                                    var selectedOptionPt = prjt_vals.options[selectedIndexPrjt];
                                                    var selectedTextPt = selectedOptionPt.text;
                                                    var prjt_val = selectedTextPt;
                                                } else {
                                                    var prjt_val = '';
                                                }
                                                var chartElements6 = document.querySelector('#spline_area');
                                                html2canvas(chartElements6).then(pt => {
                                                    // use the canvas to create a PNG image
                                                    document.body.appendChild(pt)
                                                    const ptImage = pt.toDataURL('image/png');
                                                    dataArray.push(ptImage);
                                                    selectedChartCat.push(prjt_val);
                                                    myArray.push('Project');


                                                    //Task
                                                    var chartElement7 = document.querySelector('#lineChart');
                                                    html2canvas(chartElement7).then(tt => {
                                                        // use the canvas to create a PNG image
                                                        document.body.appendChild(tt)
                                                        const ttImage = tt.toDataURL('image/png');
                                                        console.log(ttImage);
                                                        dataArray.push(ttImage);
                                                        myArray.push('Task');
                                                        selectedChartCat.push(' ');

                                                        //Sub Task
                                                        var chartElement8 = document.querySelector('#lineChart_subtask');
                                                        html2canvas(chartElement8).then(stt => {
                                                            // use the canvas to create a PNG image
                                                            document.body.appendChild(stt)
                                                            const sttImage = stt.toDataURL('image/png');
                                                            console.log(sttImage);
                                                            dataArray.push(sttImage);
                                                            myArray.push('Sub Task');
                                                            selectedChartCat.push(' ');
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                                // });
                            });
                            setTimeout(function() {
                                mainReport(daterangestart, daterangeend, hide);
                            }, 30000);
                        }

                        if (newStr === 'my_work') {


                            await new Promise(resolve => {
                                setTimeout(() => {
                                    //Task
                                    var chartElement_work = document.querySelector('#column_chart');
                                    html2canvas(chartElement_work).then(st_work => {
                                        // use the canvas to create a PNG image
                                        document.body.appendChild(st_work)
                                        const stImage_work = st_work.toDataURL('image/png');
                                        dataArray.push(stImage_work);
                                        myArray.push('My Work');
                                        selectedChartCat.push(' ');
                                    });
                                    resolve();
                                }, 2000);
                            });
                        }

                        if (newStr === 'portfolio') {

                            //portfolio
                            await new Promise(resolve => {
                                setTimeout(() => {

                                    var chartElements = document.querySelector('#donut-chart-portfolio');
                                    html2canvas(chartElements).then(donut => {
                                        // use the canvas to create a PNG image
                                        document.body.appendChild(donut)
                                        const donutImage = donut.toDataURL('image/png');
                                        dataArray.push(donutImage);
                                    });
                                    myArray.push('Portfolio');
                                    selectedChartCat.push(' ');

                                    resolve();
                                }, 2000);
                            });
                        }

                        if (newStr === 'portfolio_tsk') {
                            await new Promise(resolve => {
                                setTimeout(() => {
                                    //Task
                                    var chartElement7 = document.querySelector('#lineChart');
                                    html2canvas(chartElement7).then(tt => {
                                        // use the canvas to create a PNG image
                                        document.body.appendChild(tt)
                                        const ttImage = tt.toDataURL('image/png');
                                        dataArray.push(ttImage);
                                        myArray.push('Task');
                                        selectedChartCat.push(' ');
                                    });
                                    resolve();
                                }, 2000);
                            });
                        }

                        if (newStr === 'portfolio_stsk') {
                            await new Promise(resolve => {
                                setTimeout(() => {
                                    //Task
                                    var chartElement8 = document.querySelector('#lineChart_subtask');
                                    html2canvas(chartElement8).then(st => {
                                        // use the canvas to create a PNG image
                                        document.body.appendChild(st)
                                        const stImage = st.toDataURL('image/png');
                                        dataArray.push(stImage);
                                        myArray.push('Sub Task');
                                        selectedChartCat.push(' ');
                                    });
                                    resolve();
                                }, 2000);
                            });
                        }

                        if (newStr === 'portfolio_cnt') {
                            await new Promise(resolve => {
                                setTimeout(() => {
                                    var sel_cont = $('#sel_cnt').val();
                                    var sel_cont_array = sel_cont;
                                    var cnthasSelectedValue = false;
                                    for (var i = 0; i < sel_cont_array.length; i++) {
                                        var cntselect = sel_cont_array[i];
                                        var selectedOptionscnt = cntselect;

                                        if (selectedOptionscnt.length > 0) {
                                            cnthasSelectedValue = true;
                                            break;
                                        }
                                    }
                                    if (cnthasSelectedValue) {
                                        $('#cntErr').text('');
                                        sel_cont_array.forEach(async function(element3) {
                                            await contentUserReport(portfolio_id, element3, daterangestart, daterangeend);
                                        });
                                        setTimeout(function() {
                                            mainReport(daterangestart, daterangeend, hide);
                                        }, 30000);
                                    } else {
                                        $('#cntErr').text('No content is selected');
                                        $('#loaderModal').modal('hide');
                                        $('#exampleModal').modal('show');
                                        document.getElementById("download_pdf").disabled = false;
                                        document.getElementById("download_ppt").disabled = false;
                                        return false;
                                    }
                                    resolve();
                                }, 2000);
                            });

                        }

                        if (newStr === 'portfolio_pjt') {

                            await new Promise(resolve => {
                                setTimeout(() => {
                                    var sel_prjt = $('#sel_prjt').val();
                                    var sel_prjt_array = sel_prjt;

                                    var hasSelectedValueprjt = false;
                                    for (var i = 0; i < sel_prjt_array.length; i++) {
                                        var selectprjt = sel_prjt_array[i];
                                        var selectedOptionsPrjt = selectprjt;
                                        if (selectedOptionsPrjt.length > 0) {
                                            hasSelectedValueprjt = true;
                                            break;
                                        }
                                    }
                                    if (hasSelectedValueprjt) {
                                        $('#prjtErr').text('');
                                        sel_prjt_array.forEach(async function(element2) {
                                            await projectUserReport(portfolio_id, element2, daterangestart, daterangeend);
                                        });
                                        setTimeout(function() {
                                            mainReport(daterangestart, daterangeend, hide);
                                        }, 30000);
                                    } else {
                                        $('#prjtErr').text('No project is selected');
                                        $('#loaderModal').modal('hide');
                                        $('#exampleModal').modal('show');
                                        document.getElementById("download_pdf").disabled = false;
                                        document.getElementById("download_ppt").disabled = false;
                                        return false;
                                    }
                                    resolve();
                                }, 2000);
                            });

                        }

                        if (newStr === 'portfolio_dept') {

                            await new Promise(resolve => {
                                setTimeout(() => {
                                    var sel_dept = $('#sel_dept').val();
                                    var sel_dept_array = sel_dept;


                                    var depthasSelectedValue = false;
                                    for (var i = 0; i < sel_dept_array.length; i++) {
                                        var deptselect = sel_dept_array[i];
                                        var selectedOptionsdept = deptselect;

                                        if (selectedOptionsdept.length > 0) {
                                            depthasSelectedValue = true;
                                            break;
                                        }
                                    }

                                    if (depthasSelectedValue) {
                                        $('#deptErr').text('');
                                        sel_dept_array.forEach(async function(element4) {
                                            await departmentUserReport(portfolio_id, element4, daterangestart, daterangeend);
                                        });
                                        setTimeout(function() {
                                            mainReport(daterangestart, daterangeend, hide);
                                        }, 30000);
                                    } else {
                                        $('#deptErr').text('No department is selected');
                                        $('#loaderModal').modal('hide');
                                        $('#exampleModal').modal('show');
                                        document.getElementById("download_pdf").disabled = false;
                                        document.getElementById("download_ppt").disabled = false;
                                        return;
                                    }
                                    resolve();
                                }, 2000);
                            });
                        }

                        if (newStr === 'portfolio_glstr') {

                            await new Promise(resolve => {
                                setTimeout(() => {
                                    var s_gl = $('#sel_gl').val();
                                    var new_array = s_gl;
                                    var hasSelectedValue = false;
                                    for (var i = 0; i < new_array.length; i++) {
                                        var select = new_array[i];
                                        var selectedOptions = select;
                                        if (selectedOptions.length > 0) {
                                            hasSelectedValue = true;
                                            break;
                                        }
                                    }
                                    if (hasSelectedValue) {
                                        $('#goalErr').text('');

                                        new_array.forEach(async function(element) {
                                            await goalUserReport(portfolio_id, element, daterangestart, daterangeend);
                                        });
                                        setTimeout(function() {
                                            mainReport(daterangestart, daterangeend, hide);
                                        }, 30000);
                                    } else {
                                        $('#goalErr').text('No goal is selected');
                                        $('#loaderModal').modal('hide');
                                        $('#exampleModal').modal('show');
                                        document.getElementById("download_pdf").disabled = false;
                                        document.getElementById("download_ppt").disabled = false;
                                        return false;
                                    }
                                    resolve();
                                }, 2000);
                            });
                        }
                    }

                })();



            }
        }
    });
}


function mainReport(daterangestart, daterangeend, hide) {
    // for (let jk = 0; jk < dataArray.length; jk++) {
    //    const element = dataArray[jk];
    //    console.log(element);

    // }
    var hideValue = hide.val();
    var template = $('#report_name').val();
    var pdf = $('#hide_pdf').val();
    var ppt = $('#hide_ppt').val();

    if (pdf === '1') {
        var report_for = '1'
    } else {
        var report_for = '2'

    }
    $.ajax({
        url: base_url + 'front/generate_userreport',
        type: 'post',
        data: {
            myArray_user: myArray,
            selectedChartCat_user: selectedChartCat,
            stick_user: dataArray,
            template_user: template,
            daterangestart_user: daterangestart,
            daterangeend_user: daterangeend,
            report_for_user: report_for
        },
        success: function(data) {
            if (data) {
                if (pdf === hideValue) {
                    window.location = base_url + 'front/pdfUserRepExport';
                } else if (ppt === hideValue) {
                    window.location = base_url + 'front/generate_Userppt';
                }
            }
            setTimeout(function() {
                if (report_for == '2') {
                    $('#loaderModal').modal('hide');
                    // $('#exampleModal').modal('show');
                    // $('#exampleModal').modal('hide'); 
                    $('#exampleModal ').load(document.URL + ' #exampleModal >*');
                    document.getElementById("download_pdf").disabled = false;
                    document.getElementById("download_ppt").disabled = false;
                    window.location.reload();
                }
            }, 1000);


        }
    });
}


function show_FilterChart() {
    if ($('.filtercollapse').css('display', 'block')) {
        $('.filtercollapse').css('display', 'none');
    }
    if ($('.filtercollapse').css('display', 'none')) {
        $('.filtercollapse').css('display', 'block');
    }
}

$("input[name='myReport']").click(function() {
    debugger;
    $('.filtercollapse').css('display', 'none');

    var myReport = $(this).val();

    if (myReport == 'all') {
        $("#port_hide, #ind_hide, #dept_hide, #goal_hide, #cnt_hide, #prjt_hide, #tsk_hide, #stsk_hide").show();
    } else if (myReport == 'portfolio') {
        $('#port_hide').show();
        $("#mem_hide, #ind_hide, #dept_hide, #goal_hide, #cnt_hide, #prjt_hide, #tsk_hide, #stsk_hide").hide();
    } else if (myReport == 'task') {
        $('#tsk_hide').show();
        $("#port_hide, #ind_hide, #dept_hide, #goal_hide, #cnt_hide, #prjt_hide, #stsk_hide").hide();
    } else if (myReport == 'subtask') {
        $('#stsk_hide').show();
        $("#port_hide, #ind_hide, #dept_hide, #goal_hide, #cnt_hide, #prjt_hide, #tsk_hide").hide();
    } else if (myReport == 'content') {
        $('#cnt_hide').show();
        $("#port_hide, #ind_hide, #dept_hide, #goal_hide,#prjt_hide, #tsk_hide, #stsk_hide").hide();
    } else if (myReport == 'team_performance') {
        $('#ind_hide').show();
        $("#port_hide, #dept_hide, #goal_hide, #cnt_hide, #prjt_hide, #tsk_hide, #stsk_hide").hide();
    } else if (myReport == 'department') {
        $('#dept_hide').show();
        $("#port_hide, #ind_hide, #goal_hide, #cnt_hide, #prjt_hide, #tsk_hide, #stsk_hide").hide();
    } else if (myReport == 'goal') {
        $('#goal_hide').show();
        $("#port_hide, #ind_hide, #dept_hide, #cnt_hide, #prjt_hide, #tsk_hide, #stsk_hide").hide();
    } else if (myReport == 'project') {
        $('#prjt_hide').show();
        $("#port_hide, #ind_hide, #goal_hide, #dept_hide, #cnt_hide, #tsk_hide, #stsk_hide").hide();
    }
});

//preview modal for report  file
function previewUSerFile(id) {
    var id = id;
    // AJAX request
    $.ajax({
        url: base_url + 'front/preview_user_report',
        type: 'post',
        data: {
            id: id
        },
        success: function(data) {
            // Add response in Modal body
            $('#previewUserFile_content').html(data);
            // Display Modal
            $('#previewUserModal').modal('show');
        }
    });
}

function delete_Userreport(id) {
    var id = id;
    Swal.fire({
        title: "Are you sure?",
        text: "You want to Delete File",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c7df19",
        cancelButtonColor: "#383838",
        confirmButtonText: "Yes"
    }).then(function(result) {
        if (result.value) {
            // AJAX request
            $.ajax({
                url: base_url + 'front/delete_Userrept',
                type: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    Swal.fire("File Deleted!", "Successfully.", "success");
                    window.location.reload();
                }
            });
        }
    });
}