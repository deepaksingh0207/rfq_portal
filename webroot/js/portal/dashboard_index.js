$(document).ready(function () {
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#reportrange span").html(
            start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"),
        );
    }
    $("#reportrange").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                // Today: [moment(), moment()],
                // Yesterday: [
                //     moment().subtract(1, "days"),
                //     moment().subtract(1, "days"),
                // ],
                // "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb,
    );
    cb(start, end);

    /***********select2**************** */
    $(".select2").select2({
        theme:"bootstrap4"
    });

    let seriesData = [5517, 15689, 20254]; // Pending, In-Progress, PO Created
    let labels = ["Pending", "In-Progress", "PO Created"];

    let prStatusoptions = {
        series: seriesData,
        chart: {
            type: "donut",
            height: 280,
        },
        labels: labels,
        colors: ["#BFE4FF", "#6EC1FF", "#1495FF"],
        stroke: {
            width: 4,
            colors: ["#fff"],
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "60%",
                },
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(2) + "%";
            },
            style: {
                fontSize: "12px",
                fontWeight: "600",
            },
            background: {
                enabled: true,
                borderRadius: 4,
                foreColor: "#000",
            },
            dropShadow: {
                enabled: false,
            },
        },
        legend: {
            position: "bottom",
            formatter: function (seriesName, opts) {
                return `
                <span style="display:inline-flex;align-items:center;gap:6px">
                    ${seriesName}
                    <strong>${opts.w.globals.series[opts.seriesIndex].toLocaleString()}</strong>
                </span>
            `;
            },
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value.toLocaleString();
                },
            },
        },
    };

    let prStatusChart = new ApexCharts(
        document.querySelector("#prStatusChart"),
        prStatusoptions,
    );

    prStatusChart.render();

    seriesData = [986, 665, 200]; // >60d, 31–60d, 0–30d
    labels = [">60 days", "31–60 days", "0–30 days"];

    let prAgingoptions = {
        series: seriesData,
        labels: labels,
        chart: {
            type: "donut",
            height: 270,
        },
        colors: ["#FFB703", "#FFD166", "#FFF1D6"],
        stroke: {
            width: 4,
            colors: ["#fff"],
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "62%",
                },
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return opts.w.globals.series[opts.seriesIndex];
            },
            style: {
                fontSize: "12px",
                fontWeight: 600,
            },
            background: {
                enabled: true,
                borderRadius: 4,
                foreColor: "#000",
            },
            dropShadow: {
                enabled: false,
            },
        },
        legend: {
            position: "bottom",
            markers: {
                width: 10,
                height: 10,
                radius: 2,
            },
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value.toLocaleString();
                },
            },
        },
    };

    let prAgingChart = new ApexCharts(
        document.querySelector("#prAgingChart"),
        prAgingoptions,
    );

    prAgingChart.render();

    const data = [
        { name: "Consumables-Prodn.", value: 3165.07 },
        { name: "Prod. Cons. Gaskets", value: 2692.27 },
        { name: "Cooling System", value: 2692.27 },
        { name: "ELECTROSTATIC DI GST", value: 2692.27 },
        { name: "INLET & EX MANIFOLD", value: 2692.27 },
        { name: "RM - Zinc", value: 2692.27 },
        { name: "Furnace & Refractories", value: 2692.27 },
        { name: "Services - Opex", value: 2692.27 },
    ];

    const total = data.reduce((sum, d) => sum + d.value, 0);

    let spendCategoryTreeChart = echarts.init(
        document.getElementById("spendCategoryTree"),
    );

    const option = {
        tooltip: {
            formatter: function (info) {
                const value = info.value;
                const percent = ((value / total) * 100).toFixed(2);
                return `
        <strong>${info.name}</strong><br>
        ₹${value.toLocaleString()} L<br>
        ${percent}%
      `;
            },
        },
        series: [
            {
                type: "treemap",
                data: data,
                roam: false,
                nodeClick: false,
                breadcrumb: { show: false },
                label: {
                    show: true,
                    formatter: function (params) {
                        const percent = ((params.value / total) * 100).toFixed(
                            2,
                        );
                        return `{name|${params.name}}\n{percent|${percent}%}\n{value|₹${params.value.toLocaleString()} L}`;
                    },
                    rich: {
                        name: {
                            fontSize: 13,
                            fontWeight: "600",
                            color: "#fff",
                            lineHeight: 18,
                        },
                        percent: {
                            fontSize: 12,
                            color: "#fff",
                            lineHeight: 16,
                        },
                        value: {
                            fontSize: 12,
                            fontWeight: "600",
                            color: "#fff",
                            lineHeight: 16,
                        },
                    },
                },
                upperLabel: { show: false },
                itemStyle: {
                    borderRadius: 6,
                    gapWidth: 6,
                    borderColor: "#fff",
                },
            },
        ],
    };

    spendCategoryTreeChart.setOption(option);

    const cycleTimeChart = echarts.init(
        document.getElementById("cycleTimeChart"),
    );

    const categories = [
        "<1 Week",
        "1-2 Weeks",
        "2-3 Weeks",
        "3-4 Weeks",
        ">4 Weeks",
    ];

    const barData = [28000, 46000, 75000, 72000, 52000];
    const lineData = [15000, 28000, 75000, 72000, 35000];

    const cycleTimeChartOption = {
        grid: {
            left: 40,
            right: 20,
            top: 60,
            bottom: 40,
        },

        title: [
            {
                text: "Cycle Time",
                left: "left",
                top: 10,
                textStyle: {
                    fontSize: 16,
                    fontWeight: 600,
                },
            },
            {
                text: "Avg. Procurement Cycle Time: 56 Days",
                right: "right",
                top: 12,
                textStyle: {
                    fontSize: 12,
                    fontWeight: 500,
                },
            },
        ],

        xAxis: {
            type: "category",
            data: categories,
            axisTick: { show: false },
            axisLine: { show: false },
        },

        yAxis: {
            type: "value",
            axisLine: { show: false },
            axisTick: { show: false },
            splitLine: {
                lineStyle: { type: "dashed", color: "#e5e7eb" },
            },
            axisLabel: {
                formatter: (value) => {
                    if (value === 0) return "0";
                    if (value === 100000) return "1.00L";
                    return value / 1000 + ".00k";
                },
            },
        },

        series: [
            /* Bars */
            {
                type: "bar",
                data: barData,
                barWidth: "55%",
                itemStyle: {
                    color: "#74C0FC",
                    borderRadius: [6, 6, 0, 0],
                },
                z: 1,
            },

            /* Smooth Line */
            {
                type: "line",
                data: lineData,
                smooth: true,
                symbol: "circle",
                symbolSize: 8,
                lineStyle: {
                    width: 2,
                    color: "#1C7ED6",
                },
                itemStyle: {
                    color: "#1C7ED6",
                },
                z: 2,
            },
        ],

        tooltip: {
            trigger: "axis",
            axisPointer: { type: "shadow" },
        },
    };

    cycleTimeChart.setOption(cycleTimeChartOption);

    /* ---------------- Contract Expiry ---------------- */
    let contractExpiryChart = new ApexCharts(
        document.querySelector("#contractExpiryChart"),
        {
            chart: {
                type: "bar",
                height: 280,
                toolbar: { show: false },
            },
            series: [
                {
                    name: "Contracts",
                    data: [32, 65, 5, 82, 44, 100],
                },
            ],
            colors: ["#42A5F5"],
            xaxis: {
                labels: {
                    style: {
                        fontSize: "10px",
                    },
                },
                categories: [
                    "Sept - 2025",
                    "Oct - 2025",
                    "Nov - 2025",
                    "Dec - 2025",
                    "March - 2026",
                    "June - 2026",
                ],
            },
            grid: { strokeDashArray: 4 },
            dataLabels: { enabled: false },
        },
    );
    contractExpiryChart.render();

    /* ---------------- Spend By Award Type ---------------- */
    let awardTypeChart = new ApexCharts(
        document.querySelector("#awardTypeChart"),
        {
            chart: {
                type: "bar",
                height: 280,
                toolbar: { show: false },
            },
            series: [
                {
                    data: [24000, 6500, 4800, 11000],
                },
            ],
            colors: ["#38E760"],
            xaxis: {
                labels: {
                    style: {
                        fontSize: "10px",
                    },
                },
                categories: ["Regular", "Repeat PO", "RC PO", "Standalone"],
            },
            grid: { strokeDashArray: 4 },
            dataLabels: { enabled: false },
        },
    );
    awardTypeChart.render();

    /* ---------------- Spend By Award Category ---------------- */
    let awardCategoryChart = new ApexCharts(
        document.querySelector("#awardCategoryChart"),
        {
            chart: {
                type: "bar",
                height: 280,
                toolbar: { show: false },
            },
            series: [
                {
                    data: [500, 4800, 22000, 7500, 1800, 2800],
                },
            ],
            colors: ["#7E7CE3"],
            xaxis: {
                labels: {
                    style: {
                        fontSize: "8px",
                    },
                },
                categories: [
                    "Authorized Dealer",
                    "Inter Company",
                    "Manufacturer",
                    "Service Provider",
                    "Trader",
                    "Others",
                ],
            },
            tooltip: {
                y: {
                    formatter: (val) => `₹ ${val.toLocaleString()} L`,
                },
            },
            grid: { strokeDashArray: 4 },
            dataLabels: { enabled: false },
        },
    );
    awardCategoryChart.render();

    $("#reportrange").on("apply.daterangepicker", function (ev, picker) {
        let startDate = picker.startDate.format("YYYY-MM-DD");
        let endDate = picker.endDate.format("YYYY-MM-DD");
        console.log("New Range Selected: " + startDate + " to " + endDate);

        if (endDate == "2026-02-28") {
            $("#total_spend_h_tag").text("₹14,594.28L");
            $("#today_pr_count_h_tag").text("0");
            $("#total_pr_count_h_tag").text("14,281");
            $("#po_converted_count_h_tag").text("11,586");
            $("#savings_lpo_h_tag").text("₹9,821.00L");
            $("#cost_avoidance_h_tag").text("₹21,478.00L");

            $("#via_arc_count").text("102");
            $("#via_arc_percentage").text("(0.46%)");
            $("#via_arc_total_value").text("₹ 861.22L");
            $("#via_arc_total_value_percentage").text("(0.94%");

            $("#via_rfx_count").text("158");
            $("#via_rfx_percentage").text("(1.13%)");
            $("#via_rfx_total_value").text("₹ 1,235.55L");
            $("#via_rfx_total_value_percentage").text("(2.27%)");

            $("#via_repeat_po_count").text("172");
            $("#via_repeat_po_percentage").text("(1.21%)");
            $("#via_repeat_po_total_value").text("₹ 1,480.29L");
            $("#via_repeat_po_total_value_percentage").text("(2.43%)");

            $("#via_standalone_count").text("320");
            $("#via_standalone_percentage").text("(1.88%)");
            $("#via_standalone_total_value").text("₹ 1,982.12L");
            $("#via_standalone_total_value_percentage").text("(3.97%)");

            $("#award_status_under_approval_h_tag").text("₹ 1,192.90L");
            $("#award_status_under_approval_progress_bar").css("width", "20%");
            $("#award_status_under_approval_pr_count").text("121");
            $("#award_status_under_approval_total_pr_count").text("600 PRs");

            $("#pending_po_h_tag").text("₹ 127.88L");
            $("#pending_po_progress_bar").css("width", "15%");
            $("#pending_po_pr_count").text("17");
            $("#pending_po_total_pr_count").text("127 PRs");

            $("#po_created_h_tag").text("₹ 34,931.68L");
            $("#po_created_progress_bar").css("width", "65%");
            $("#po_created_pr_count").text("19821");
            $("#po_created_total_pr_count").text("21,283 PRs");

            prStatusChart.updateSeries([10000, 5000, 4000]);
            prAgingChart.updateSeries([386, 245, 25]);
        } else if (endDate == "2026-01-31") {
            $("#total_spend_h_tag").text("₹29,432.00L");
            $("#today_pr_count_h_tag").text("0");
            $("#total_pr_count_h_tag").text("29,428");
            $("#po_converted_count_h_tag").text("26,199");
            $("#savings_lpo_h_tag").text("₹3,621.00L");
            $("#cost_avoidance_h_tag").text("₹37,729.50L");

            $("#via_arc_count").text("872");
            $("#via_arc_percentage").text("(2.46%)");
            $("#via_arc_total_value").text("₹ 2361.22L");
            $("#via_arc_total_value_percentage").text("(4.93%");

            $("#via_rfx_count").text("895");
            $("#via_rfx_percentage").text("(3.23%)");
            $("#via_rfx_total_value").text("₹ 3,825.72L");
            $("#via_rfx_total_value_percentage").text("(6.47%)");

            $("#via_repeat_po_count").text("907");
            $("#via_repeat_po_percentage").text("(3.29%)");
            $("#via_repeat_po_total_value").text("₹ 3987.36L");
            $("#via_repeat_po_total_value_percentage").text("(6.59%)");

            $("#via_standalone_count").text("925");
            $("#via_standalone_percentage").text("(3.77%)");
            $("#via_standalone_total_value").text("₹ 3,452.72L");
            $("#via_standalone_total_value_percentage").text("(7.55%)");

            $("#award_status_under_approval_h_tag").text("₹ 2,192.90L");
            $("#award_status_under_approval_progress_bar").css("width", "50%");
            $("#award_status_under_approval_pr_count").text("181");
            $("#award_status_under_approval_total_pr_count").text("700 PRs");

            $("#pending_po_h_tag").text("₹ 197.88L");
            $("#pending_po_progress_bar").css("width", "65%");
            $("#pending_po_pr_count").text("57");
            $("#pending_po_total_pr_count").text("197 PRs");

            $("#po_created_h_tag").text("₹ 38,231.68L");
            $("#po_created_progress_bar").css("width", "72%");
            $("#po_created_pr_count").text("17821");
            $("#po_created_total_pr_count").text("22,283 PRs");

            prStatusChart.updateSeries([8500, 7500, 3000]);
            prAgingChart.updateSeries([686, 225, 300]);
        } else {
            $("#total_spend_h_tag").text("₹44,931.68L");
            $("#today_pr_count_h_tag").text("0");
            $("#total_pr_count_h_tag").text("34,944");
            $("#po_converted_count_h_tag").text("31,282");
            $("#savings_lpo_h_tag").text("₹4,487.50L");
            $("#cost_avoidance_h_tag").text("₹44,931.68L");

            $("#via_arc_count").text("1,606");
            $("#via_arc_percentage").text("(5.13%)");
            $("#via_arc_total_value").text("₹ 4,519.72L");
            $("#via_arc_total_value_percentage").text("(10.06%)");

            $("#via_rfx_count").text("1,606");
            $("#via_rfx_percentage").text("(5.13%)");
            $("#via_rfx_total_value").text("₹ 4,519.72L");
            $("#via_rfx_total_value_percentage").text("(10.06%)");

            $("#via_repeat_po_count").text("1,606");
            $("#via_repeat_po_percentage").text("(5.13%)");
            $("#via_repeat_po_total_value").text("₹ 4,519.72L");
            $("#via_repeat_po_total_value_percentage").text("(10.06%)");

            $("#via_standalone_count").text("1,606");
            $("#via_standalone_percentage").text("(5.13%)");
            $("#via_standalone_total_value").text("₹ 4,519.72L");
            $("#via_standalone_total_value_percentage").text("(10.06%)");

            $("#award_status_under_approval_h_tag").text("₹ 6,192.90L");
            $("#award_status_under_approval_progress_bar").css("width", "70%");
            $("#award_status_under_approval_pr_count").text("1145");
            $("#award_status_under_approval_total_pr_count").text("1631 PRs");

            $("#pending_po_h_tag").text("₹ 827.88L");
            $("#pending_po_progress_bar").css("width", "55%");
            $("#pending_po_pr_count").text("87");
            $("#pending_po_total_pr_count").text("157 PRs");

            $("#po_created_h_tag").text("₹ 44,931.68L");
            $("#po_created_progress_bar").css("width", "85%");
            $("#po_created_pr_count").text("20006");
            $("#po_created_total_pr_count").text("31,282 PRs");

            prStatusChart.updateSeries([5517, 15689, 20254]);
            prAgingChart.updateSeries([986, 665, 200]);
        }
    });
});
