$(document).ready(function () {
    const seriesData = [5517, 15689, 20254]; // Pending, In-Progress, PO Created
    const labels = ["Pending", "In-Progress", "PO Created"];

    const options = {
        series: seriesData,
        chart: {
            type: "donut",
            height: 260,
        },
        labels: labels,
        colors: ["#BFE4FF", "#6EC1FF", "#1495FF"],
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

    const chart = new ApexCharts(
        document.querySelector("#prStatusChart"),
        options,
    );

    chart.render();
});
