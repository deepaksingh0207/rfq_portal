$(document).ready(function () {
    /***********select2**************** */
    $(".select2").select2({
        theme: "bootstrap4",
    });

    /********** date range picker ************* */
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
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
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

    let seriesData = series_data_for_pr_status_chart; // Pending, In-Progress, PO Created
    let labels = labels_for_pr_status_chart;

    let prStatusoptions = {
        series: seriesData,
        chart: {
            type: "donut",
            height: 260,
        },
        labels: labels,
        colors: ["#BFE4FF", "#6EC1FF", "#1a98ff" ,"#0e89ed" , "#1495FF"],
        stroke: {
            width: 0,
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

    let chart = new ApexCharts(
        document.querySelector("#prStatusChart"),
        prStatusoptions,
    );

    chart.render();

    seriesData = series_data_for_pr_aging_chart; // >60d, 31–60d, 0–30d
    labels = labels_for_pr_aging_chart;

    let prAgingoptions = {
        series: seriesData,
        labels: labels,
        chart: {
            type: "donut",
            height: 260,
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

    chart = new ApexCharts(
        document.querySelector("#prAgingChart"),
        prAgingoptions,
    );

    chart.render();

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

    chart = echarts.init(document.getElementById("spendCategoryTree"));

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

    chart.setOption(option);

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
    new ApexCharts(document.querySelector("#contractExpiryChart"), {
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
    }).render();

    /* ---------------- Spend By Award Type ---------------- */
    new ApexCharts(document.querySelector("#awardTypeChart"), {
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
    }).render();

    /* ---------------- Spend By Award Category ---------------- */
    new ApexCharts(document.querySelector("#awardCategoryChart"), {
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
    }).render();
});
