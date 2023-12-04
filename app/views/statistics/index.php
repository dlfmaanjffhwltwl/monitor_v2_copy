<div id="load">
    <div class="spinner-border text-white" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 px-1 zoomInOut">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 fw-bold">차량 기본 정보</h6>
                        </div>
                        <div class="col-6 tar">
                            <i class="fas fa-file-excel text-white excelBtn"></i>
                            <i class="fas fa-expand text-white expandIcon"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="searchTable" id="carTable">
                        <tr>
                            <td>그래프</td>
                            <td>
                                <select class="graph">
                                    <option value="Distance">주행거리</option>
                                    <option value="distanceLine">주행거리(선)</option>
                                    <option value="NumberOfDays">운행일수</option>
                                    <option value="speed">차량속도빈도</option>
                                    <option value="rpmTorque">RPM-TORQUE</option>
                                </select>
                            </td>
                            <td>차량</td>
                            <td>
                                <select class="selectCarTerminal text-center" disabled>
                                    <option value="all">- 전체 -</option>
                                    <?php
                                        if($data !=false){
                                            $carList = $data["carInfoList"];
                                            for($i=0;$i<count($carList);$i=$i+1){
                                                $carTerminal = $carList[$i]->carTerminal;
                                                $carName = $carList[$i]->carName;
                                                echo '<option value="'.$carTerminal.'">'.$carName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td rowspan=2>
                                <button type="button" class="btn btn-info searchBtn">검색</button>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td class="periodTd">전체기간</td>
                            <td colspan=3>
                                <input type="date" class="startDate" value="2021-12-30" disabled=true required>
                                ~
                                <input type="date" class="endDate" value="2021-12-31" disabled=true required>
                            </td>
                        </tr>
                    </table>
                    <div id="carChartDiv">
                        <div class="h680">
                            <canvas id="carChart"></canvas>
                        </div>
                        <div class="ovf-y customLegendDiv"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 px-1 zoomInOut">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 fw-bold">제동 관련 정보</h6>
                        </div>
                        <div class="col-6 tar">
                            <i class="fas fa-file-excel text-white excelBtn"></i>
                            <i class="fas fa-expand text-white expandIcon"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="searchTable" id="breakTable">
                        <tr>
                            <td>그래프선택</td>
                            <td>
                                <select class="graph">
                                    <option value="break">브레이크 입력 상태</option>
                                    <option value="acclPos">가속페달 입력 값</option>
                                </select>
                            </td>
                            <td>차량</td>
                            <td>
                                <select class="selectCarTerminal text-center" disabled>
                                    <option value="all">- 전체 -</option>
                                    <?php
                                        if($data !=false){
                                            $carInfoList = $data["carInfoList"];
                                            for($i=0;$i<count($carList);$i=$i+1){
                                                $carTerminal = $carList[$i]->carTerminal;
                                                $carName = $carList[$i]->carName;
                                                echo '<option value="'.$carTerminal.'">'.$carName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td rowspan=2>
                                <button type="button" class="btn btn-info searchBtn">검색</button>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td class="periodTd">전체기간</td>
                            <td colspan=3>
                                <input type="date" class="startDate" value="2021-12-30" disabled=true required>
                                ~
                                <input type="date" class="endDate" value="2021-12-31" disabled=true required>
                            </td>
                        </tr>
                    </table>
                    <div id="breakChartDiv">
                        <div class="h680">
                            <canvas id="breakChart"></canvas>
                        </div>
                        <div class="ovf-y customLegendDiv"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 px-1 zoomInOut">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 fw-bold">자세 제어 정보</h6>
                        </div>
                        <div class="col-6 tar">
                            <i class="fas fa-file-excel text-white excelBtn"></i>
                            <i class="fas fa-expand text-white expandIcon"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="searchTable" id="postureTable">
                        <tr>
                            <td>그래프선택</td>
                            <td>
                                <select class="graph">
                                    <option value="Acc_ALA">횡가속도</option>
                                    <option value="Acc_YACC">종가속도</option>
                                    <option value="Acc_YR">요레이트</option>
                                </select>
                            </td>
                            <td>차량</td>
                            <td>
                                <select class=" selectCarTerminal text-center" disabled>
                                    <option value="all">- 전체 -</option>
                                    <?php 
                                        if($data !=false){
                                            $carList = $data["carInfoList"];
                                            for($i=0;$i<count($carList);$i=$i+1){
                                                $carTerminal = $carList[$i]->carTerminal;
                                                $carName = $carList[$i]->carName;
                                                echo '<option value="'.$carTerminal.'">'.$carName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td rowspan=2>
                                <button type="button" class="btn btn-info searchBtn">검색</button>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td class="periodTd">전체기간</td>
                            <td colspan=3>
                                <input type="date" class="startDate" value="2021-12-30" disabled=true required>
                                ~
                                <input type="date" class="endDate" value="2021-12-31" disabled=true required>
                            </td>
                        </tr>
                    </table>
                    <div id="postureChartDiv">
                        <div class="h680">
                            <canvas id="postureChart"></canvas>
                        </div>
                        <div class="ovf-y customLegendDiv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--chart.js ,ExcelJS,htm12canvas 라이브러리 호출 -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/chart.js/datalabels.min.js"></script>
<script src="vendor/chart.js/hammer.min.js"></script>
<script src="vendor/chart.js/chartjs-plugin-zoom.min.js"></script>

<script src="vendor/ExcelJS/exceljs.min.js"></script>
<script src="vendor/ExcelJS/FileSaver.min.js"></script>
<script src="vendor/html2canvas/html2canvas.min.js"></script>


<script>
var selectGraph; //선택한 그래프
var carNameObject = new Object(); //자동차 이름 전역함수
var resData = new Object(); //검색정보 전역함수
var carObject = { //차트 객체를 담을 오브젝트 변수 생성
    carChart: null,
    breakChart: null,
    postureChart: null,
};

//차트 색상 리스트
var colorList = ["#9575CD", "#7986CB", "#7E57C2", "#5C6BC0", "#673AB7", "#3F51B5",
    "#5E35B1", "#3949AB", "#512DA8", "#303F9F"
];



//데이터 라벨 만드는 함수
function makeDataLabel(column) {
    var result = new Object();
    var labelList;
    var dataList = [];
    var yTitle;
    var xTitle;
    var label;
    var chartType = "bar";
    var datalabels = true;
    var legendDisplay = false;
    var animation = true;
    console.log("컬럼>>>" + column);
    switch (column) {
        case "Distance":
            yTitle = "누적주행거리(km)";
            label = "Car_terminal";
            break;
        case "distanceLine":
            yTitle = "누적주행거리(km)";
            chartType = "line";
            label = "date";
            datalabels = false;
            break;
        case "NumberOfDays":
            yTitle = "누적운행일수(day)";
            label = "Car_terminal";
            break;
        case "speed":
            yTitle = "빈도(%)";
            label = "category";
            xTitle = "차속빈도(km/h)";
            break;
        case "rpmTorque":
            yTitle = "rpm";
            label = "carTerminal";
            xTitle = "토크";
            chartType = "bubble";
            datalabels = false;
            animation = false;
            break;
        case "break":
            yTitle = "브레이크 입력 상태";
            label = "Car_terminal";
            break;
        case "acclPos":
            yTitle = "가속페달 입력 값";
            label = "category";
            xTitle = "입력 빈도수";
            break;
        case "Acc_ALA":
            yTitle = "횡가속도";
            label = "Car_terminal";
            break;
        case "Acc_YACC":
            yTitle = "종가속도";
            label = "Car_terminal";
            break;
        case "Acc_YR":
            yTitle = "요레이트";
            label = "Car_terminal";
            break;
        default:
            yTitle = "";
            xTitle = "";
    }

    if (column == "rpmTorque") {
        chartType = "bubble";
        var rValue = 5;
    }

    result["animation"] = animation;
    result["chartType"] = chartType;
    result["labelKey"] = label;
    result["yTitle"] = yTitle;
    result["xTitle"] = xTitle;
    result["datalabels"] = datalabels;
    result["legendDisplay"] = legendDisplay;
    if (rValue) {
        result["rValue"] = rValue;
    }

    return result;
}

//차트 데이터셋 만드는 함수
function makeDataSetLabel(data, column, label) {
    var showLine = true;
    var labelList = [];
    var dataSetList = [];
    var result = new Object();
    console.log(data[0]);
    if (column == "rpmTorque") {
        var carTerminal = data[0]["Car_terminal"];
        var map = new Object();
        var mapList = [];
        var dataList = [];
        var cnt = 0;
        var cnt2 = 0;
        var rValue = 5;
        for (d of data) {
            if (carTerminal != d["Car_terminal"]) {
                map = new Object();
                map["carTerminal"] = d["Car_terminal"];
                carTerminal = d["Car_terminal"];
                map["dataList"] = dataList;
                mapList.push(map);
                dataList = [];
                carTerminal = d["Car_terminal"];
                var dataSet = {
                    pointRadius: 1.5,
                    label: carNameObject[map["carTerminal"]], // Name the series
                    data: map["dataList"], // Specify the data values array
                    borderColor: colorList[cnt2], // Add custom color border            
                    backgroundColor: colorList[cnt2], // Add custom color background (Points and Fill)
                };
                cnt2++;
                dataSetList.push(dataSet);
            }
            dataList.push({
                x: d["MCU_MotToq"],
                y: d["MCU_MotSpd"],
                r: rValue,
            });
            cnt++
            if (data.length == cnt) {
                map = new Object();
                map["carTerminal"] = d["Car_terminal"];
                map["dataList"] = dataList;
                mapList.push(map);
                dataList = [];
                carTerminal = d["Car_terminal"];
                var dataSet = {
                    pointRadius: 1.5,
                    label: carNameObject[map["carTerminal"]], // Name the series
                    data: map["dataList"], // Specify the data values array
                    borderColor: colorList[cnt2], // Add custom color border            
                    backgroundColor: colorList[cnt2], // Add custom color background (Points and Fill)
                };
                dataSetList.push(dataSet);
            }

        }

    } else if (column == "distanceLine") {
        var cntData = 0;
        var keyList = Object.keys(data);
        for (d in data) {
            var dataList = [];
            var dotDataList = [];
            var list = data[d];
            for (i of list) {
                if (cntData == 0) {
                    labelList.push(i["date"]);
                }
                if (!i["driving"]) {
                    dotDataList.push(null);
                } else {
                    dotDataList.push(i["distanceLine"]);
                }
                dataList.push(i["distanceLine"]);
            }
            var dataSet = {
                label: carNameObject[d],
                fill: false,
                borderWidth: 5,
                pointRadius: 0,
                borderColor: colorList[cntData],
                backgroundColor: colorList[cntData],
                data: dataList,
                borderRadius: 15,
                showLine: showLine,
                tension: 0.1, // 선부드럽게
                hidden: false,
            };
            var dataSet2 = {
                label: carNameObject[d],
                fill: false,
                borderColor: colorList[cntData],
                backgroundColor: colorList[cntData],
                data: dotDataList,
                pointRadius: 5,
                showLine: false,
            };
            dataSetList.push(dataSet);
            dataSetList.push(dataSet2);
            cntData++;
        }

    } else {
        var dataList = [];
        for (d of data) {
            dataList.push(d[column]);
            if (label == "Car_terminal") {
                labelList.push(carNameObject[d[label]]);
            } else {
                labelList.push(d[label]);
            }
        }
        console.log("데이터리스트체크");
        console.log(dataList);
        var dataSet = {
            fill: false,
            borderColor: colorList,
            backgroundColor: colorList,
            data: dataList,
            borderRadius: 15,
            showLine: showLine,
            tension: 0.1, // 선부드럽게
            hidden: false,
        };
        dataSetList.push(dataSet);
    }

    result["labelList"] = labelList;
    result["dataSetList"] = dataSetList;
    console.log("labelList", labelList);
    console.log("dataSetList", dataSetList);
    return result;
}

//차트 생성 함수
function carChartMaker(chart, data, column) {
    if (carObject[chart] != null) { //기존 차트가 있다면 파괴 
        carObject[chart].destroy();
    }

    //carChart.destroy();
    var ctx = document.getElementById(chart);
    var dataLabels = makeDataLabel(column);
    var dataSetLabel = makeDataSetLabel(data, column, dataLabels["labelKey"]);

    customLegendShow(chart, data, column, dataSetLabel["dataSetList"]);

    carObject[chart] = new Chart(ctx, { //차트 객체 생성 
        type: dataLabels["chartType"],
        plugins: [ChartDataLabels], //ChartDataLabels는 chart.js 플러그인으로 막대 위에 숫자 표기 해주는 플러그인
        data: {
            labels: dataSetLabel["labelList"],
            datasets: dataSetLabel["dataSetList"],
        },
        options: {
            animation: dataLabels["animation"],
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 20,
                    bottom: 0
                }
            },

            scales: {
                x: {
                    // min: -120,
                    // max: 120,
                    ticks: {
                        stepSize: 5,
                        maxRotation: 35,
                        minRotation: 35
                    },
                    grid: {
                        color: '#656565',
                    },
                    title: {
                        display: true,
                        text: dataLabels["xTitle"],
                        font: {
                            size: 15,
                            style: "bold",
                        },
                        padding: {
                            top: 0,
                            bottom: 0,
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: dataLabels["yTitle"],
                        font: {
                            size: 15,
                            style: "bold",
                        },
                        padding: {
                            top: -5,
                            bottom: 0,
                        }
                    },
                    grid: {
                        color: '#656565',
                    },
                }
            },
            tooltips: { //막대에 호버 했을때 나타나는 툴팁
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                caretPadding: 10,
            },
            plugins: {
                legend: {
                    display: dataLabels["legendDisplay"],
                    position: "bottom",
                    align: "start",
                    labels: {
                        filter: function(item, chart) {
                            if (item.datasetIndex % 2 == 1) {
                                return false;
                            } else {
                                return item;
                            }
                        }
                    },
                    onClick: function(e, legendItem, legend) {
                        var ci = legend.chart;
                        var index = legendItem.datasetIndex;
                        if (ci.data.datasets[index].hidden) {
                            ci.data.datasets[index].hidden = false;
                            ci.data.datasets[index + 1].hidden = false;
                        } else {
                            ci.data.datasets[index].hidden = true;
                            ci.data.datasets[index + 1].hidden = true;
                        }
                        ci.update();
                    },
                },
                datalabels: { // datalables 플러그인 세팅
                    formatter: function(value, context) {
                        var idx = context.dataIndex; // 각 데이터 인덱스
                        // 출력 텍스트
                        return value;
                    },
                    color: "rgb(170, 170, 170)",
                    anchor: 'start',
                    align: 'end',
                    display: dataLabels["datalabels"],
                },
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'x'
                    },
                    zoom: {
                        wheel: {
                            enabled: true
                        },
                        pinch: {
                            enabled: true
                        },
                        mode: 'x'
                    }
                },
            },
        }
    });
}



$(document).ready(function() {
    var data = <?= json_encode($data)?>; //그래프 데이터를 담는 변수
    var carInfo = data["carInfoList"]; //차량 정보를 담는 변수
    delete data.carInfoList; //차량정보 객체에서 삭제

    for (car of carInfo) {
        carNameObject[car["Car_terminal"]] = car["Car_name"];
    }

    for (var i = 0; i < carInfo.length; i++) {
        var car = carInfo[i];
        var carTerminal = car.Car_terminal;
        var carName = car.Car_name;
    }

    //처음 가져오는데이터
    fetch('statistics/getDataFirst', {
            method: 'POST',
            cache: 'no-cache',
        })
        .then(res => res.json())
        .then(data => {
            if (data) {
                $("#load").hide();
                carChartMaker("carChart", data, "Distance", "bar"); //처음 보여줄 차트 생성 (차량기본정보)
            } else {
                alert("데이터가 없습니다");
            }

        })
        .catch(error => console.log(error));

    //처음가져오는 제동관련 데이터
    fetch('statistics/getBreakDataFirst', {
            method: 'POST',
            cache: 'no-cache',
        })
        .then(res => res.json())
        .then(data => {
            if (data) {
                carChartMaker("breakChart", data, "break", "bar");
            } else {
                alert("데이터가 없습니다");
            }
        })
        .catch(error => console.log(error));

    //처음가져오는 자세관련 데이터
    fetch('statistics/getPostureDataFirst', {
            method: 'POST',
            cache: 'no-cache',
        })
        .then(res => res.json())
        .then(data => {
            if (data) {
                carChartMaker("postureChart", data, "Acc_ALA", "bar");
            } else {
                alert("데이터가 없습니다");
            }
        })
        .catch(error => console.log(error));
});


// $(document).on("click", ".selectCheck", function() {
//     var canvas = $(this).parent().parent().parent().parent().parent().parent().parent().parent().find("canvas");
//     var canvasId = canvas.attr("id");
//     var index = $(this).val();
//     var isCheck = $(this).is(":checked");
//     var ci = carObject[canvasId];
//     ci.data.datasets[2 * index].hidden = !isCheck;
//     ci.data.datasets[2 * index + 1].hidden = !isCheck;
//     ci.update();
// })


//주행거리(선) 차트에서 아래 나타나는 차량이름이 있는 네모 박스를 클릭했을때 해당 하는 라인은 보이지 않토록 하는 기능
$(document).on("click", ".customLegend", function() {
    var canvas = $(this).parent().parent().parent().find("canvas");
    var canvasId = canvas.attr("id");
    var index = $(this).index();
    $(this).toggleClass("customLegendDisable");
    var ci = carObject[canvasId];
    var isSelect = $(this).hasClass("customLegendDisable");
    ci.data.datasets[2 * index].hidden = isSelect;
    ci.data.datasets[2 * index + 1].hidden = isSelect;
    ci.update();
});


//엑셀아이콘 버튼 클릭했을때 이벤트 데이터는 셀에 넣고 그래프는 이미지로 변환하여 엑셀에 나타내는 방식
$(".excelBtn").click(async function() {
    var canvas = $(this).parent().parent().parent().parent().find("canvas");
    var canvasId = canvas.attr("id");
    var chart = carObject[canvasId];
    var labelList = [];
    var dataList = [];
    var ctx = await html2canvas($("#" + canvasId + "Div")[0]); //차트 canvas 추출
    var base64Image = ctx.toDataURL(1.0);

    var workbook = new ExcelJS.Workbook();
    var worksheet = workbook.addWorksheet('Sheet');
    labelList = chart.data.labels;
    labelList.unshift("label");
    const headerRow = worksheet.addRow(chart.data.labels);
    var dataSet = chart.data.datasets;

    for (d of dataSet) { //그래프 값 추출 및 워크시트에 작성
        dataList = d.data;
        dataList.unshift(d.label);
        worksheet.addRow(dataList);
    }

    var imageId = workbook.addImage({
        base64: base64Image,
        extension: 'png',
    });

    const image = new Image();
    image.src = base64Image;
    worksheet.addImage(imageId, {
        tl: {
            col: 1,
            row: dataSet.length + 2
        },
        ext: {
            width: ctx.width,
            height: ctx.height
        }
    });
    workbook.xlsx.writeBuffer().then(function(data) { //엑셀 내보내기
        var blob = new Blob([data], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });
        saveAs(blob, "chartReal.xlsx");
    })

});

// 그래프를 변경했을 때 이벤트
$(".graph").change(function() {
    var val = $(this).val();
    var carTerminal = $(this).parent().parent().find(".selectCarTerminal");
    if (val == "rpmTorque") { // rpm-torque 그래프 일때만 차량 선택을 활성화 함
        carTerminal.prop("disabled", false);

        fetch('Statistics/showselect', {
                method: 'POST',
                cache: 'no-cache',
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                // 서버로부터 받은 JSON 데이터(data)를 사용하여 옵션을 동적으로 설정합니다.
                carTerminal.empty(); // 기존 옵션을 비웁니다
                carTerminal.append('<option value="all">- 전체 -</option'); // 전체 옵션을 추가

                // 서버에서 받은 데이터를 사용하여 옵션을 추가
                data.forEach(function(item) {
                    var carTerminalValue = item.Car_terminal;
                    var carName = item.Car_name;
                    carTerminal.append('<option value="' + carTerminalValue + '">' + carName +
                        '</option>');
                });
            })
            .catch(error => {
                console.error('오류 발생:', error);
            });
    } else {
        carTerminal.prop("disabled", true);
    }
});

//기간 클릭 이벤트
$(".periodTd").click(function() {
    var txt = $(this).text();
    var inputList = $(this).parent().find("input");
    if (txt == "기간") { //텍스트가 기간이면 전체기간으로 변경하고 날짜 수정 못하도록
        txt = "전체기간";
        inputList.eq(0).attr("disabled", true);
        inputList.eq(1).attr("disabled", true);
    } else { //텍스트가 전체기간이면 기간으로 변경하고 날짜 수정이 가능하도록 
        txt = "기간";
        inputList.eq(0).attr("disabled", false);
        inputList.eq(1).attr("disabled", false);
    }
    $(this).text(txt);
});


//주행거리(선) 차트에서 아래 나타나는 차량이름이 있는 네모 박스를 주행거리(선) 에서만 보여줄수 있도록 하는 함수
function customLegendShow(chart, data, column, labelList) {
    console.log(labelList);
    var legend = $("#" + chart + "").parent().parent().find(".customLegendDiv");

    legend.empty();
    if (column == "distanceLine") {
        var iHtml = "<ul>";
        var cnt = 0;
        for (d in data) {
            iHtml += '<li class="customLegend" style="background-color:' + colorList[cnt] + '">' + carNameObject[d] +
                '</li>';
            cnt++;
        }
        iHtml += "</ul>"
        legend.append(iHtml);
    }
}

//검색버튼 클릭이벤트
$(".searchBtn").click(function() {
    resData = {};
    let start = new Date();
    console.log("시작");
    var graph = $(this).parent().parent().find(".graph");
    var carTerminal = $(this).parent().parent().find(".selectCarTerminal");
    var searchTable = $(this).parent().parent().parent().parent();
    var startDate = $(searchTable).find(".startDate");
    var endDate = $(searchTable).find(".endDate");
    var periodTd = $(searchTable).find(".periodTd");

    selectGraph = graph.val();
    resData["table"] = searchTable.attr("id");
    resData["chart"] = searchTable.parent().find("canvas").attr("id");
    resData["graph"] = selectGraph;
    resData["periodType"] = periodTd.text();
    resData["startDate"] = startDate.val();
    resData["endDate"] = endDate.val();
    resData["carTerminal"] = carTerminal.val();
    fetch('statistics/getData', {
            method: 'POST',
            cache: 'no-cache',
            body: JSON.stringify(resData),
        })
        .then(res => res.json())
        .then(data => {
            console.log("data", data);
            let end = new Date();
            if (data) {
                carChartMaker(resData["chart"], data, selectGraph);
            } else {
                alert("데이터가 없습니다");
            }

        })
        .catch(error => console.log(error));
});

//확대 아이콘 클릭이벤트 (차트를 확대하여 볼 수있다.)
var currentExpand;
$(".expandIcon").click(function() {
    var index = $(this).parent().parent().parent().parent().parent().index();
    var zoomIn = $(".zoomInOut");
    for (var i = 0; i < zoomIn.length; i++) {
        if (currentExpand == index) {
            $(this).attr("class", "fas fa-expand text-white expandIcon")
            zoomIn.eq(i).find(".card-body").css("display", "block");
            zoomIn.eq(i).attr("class", "col-xl-4 px-1 zoomInOut");
        } else {
            if (i == index) {
                $(this).attr("class", "fas fa-compress text-white expandIcon")
                zoomIn.eq(i).find(".card-body").css("display", "block");
                zoomIn.eq(i).attr("class", "col-xl-10 px-1 zoomInOut");
            } else {
                zoomIn.eq(i).find(".card-header .expandIcon").attr("class",
                    "fas fa-expand text-white expandIcon");
                zoomIn.eq(i).find(".card-body").css("display", "none");
                zoomIn.eq(i).attr("class", "col-xl-1 px-1 zoomInOut");
            }
        }
    }
    if (currentExpand == index) {
        currentExpand = undefined;
    } else {
        currentExpand = index;
    }

});
</script>