$(function () {

    'use strict';
    //-------------
    var payments = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    3000000,
                    2000000

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Payments',
                'Not Yet Paid'
            ]
        },
        options: {
            responsive: true
        }
    };
    var invoices = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    12,
                    6

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 2'
            }],
            labels: [
                'Cleared Invoices',
                'Uncleared Invoices'
            ]
        },
        options: {
            responsive: true
        }
    };
    var LLCampus = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    45,
                    15

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 3'
            }],
            labels: [
                'Registered',
                'Not Registered'
            ]
        },
        options: {
            responsive: true
        }
    };

    var BTCampus = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    30,
                    10

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 4'
            }],
            labels: [
                'Registered',
                'Not Registered'
            ]
        },
        options: {
            responsive: true
        }
    };

    var AllCampuses = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    40,
                    60

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 4'
            }],
            labels: [
                'Blantyre',
                'Lilongwe'
            ]
        },
        options: {
            responsive: true
        }
    };
    var Finances = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    40,
                    60

                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 4'
            }],
            labels: [
                'Payments',
                'Not Yet Paid'
            ]
        },
        options: {
            responsive: true
        }
    };

    var StudentGrades = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    18,
                    15,
                    40
                ],
                backgroundColor: [
                    window.chartColors.green,
                    window.chartColors.orange
                ],
                label: 'Dataset 4'
            }],
            labels: [
                'Coursework',
                'Mid Semester',
                'Final Exam'
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function () {
        var ctx1 = document.getElementById('pieChartPayments').getContext('2d');
        window.myPie = new Chart(ctx1, payments);
        var ctx = document.getElementById('pieChartInvoices').getContext('2d');
        window.myPie = new Chart(ctx, invoices);
        var ctx2 = document.getElementById('LLCampus').getContext('2d');
        window.myPie = new Chart(ctx2, LLCampus);
        var ctx3 = document.getElementById('BTCampus').getContext('2d');
        window.myPie = new Chart(ctx3, BTCampus);
        var ctx4 = document.getElementById('AllCampuses').getContext('2d');
        window.myPie = new Chart(ctx4, AllCampuses);
        var ctx5 = document.getElementById('Finances').getContext('2d');
        window.myPie = new Chart(ctx5, Finances);
        var ctx6 = document.getElementById('StudentGrades').getContext('2d');
        window.myPie = new Chart(ctx6, StudentGrades);

    };

    $('.box ul.nav a').on('shown.bs.tab', function () {
        invoices.redraw();

    });
});