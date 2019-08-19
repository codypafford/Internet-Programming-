function calcSum(ARRAY) {
    let arrayLength = ARRAY.length;
    let sum = 0;
    for (let i = 0; i < arrayLength; i++) {
        sum = sum + ARRAY[i];
    }

    return sum.toFixed(2);
}

function findMax(ARRAY) {
    let some_num = Math.max.apply(Math, ARRAY);
    return some_num.toFixed(2);
}

function findMin(ARRAY) {
    let some_num = Math.min.apply(Math, ARRAY);
    return some_num.toFixed(2);
}

function calcMean(ARRAY) {
    let sum = calcSum(ARRAY);
    let arraySize = ARRAY.length;
    let some_num = sum / arraySize;
    return some_num.toFixed(2);
}

function calcMedianARRAY(ARRAY) {

    if (ARRAY.length === 0) return 0;

    ARRAY.sort(function (a, b) {
        return a - b;
    });

    const half = Math.floor(ARRAY.length / 2);

    if (ARRAY.length % 2)
        return ARRAY[half];

    let some_num = (ARRAY[half - 1] + ARRAY[half]) / 2.0;
    return some_num.toFixed(2);

}

function calcVariance(ARRAY) {
    let mean = calcMean(ARRAY);
    let sum_of_squares = 0;
    for (var i = 0; i < ARRAY.length; i++) {
        let num = ARRAY[i];
        let numerator = num - mean;
        let numerator_squared = Math.pow(numerator, 2);
        sum_of_squares = sum_of_squares + numerator_squared;
    }
    let ans = sum_of_squares/(ARRAY.length);
    return ans.toFixed(2);

}

function calcMode(ARRAY) {

    var modes = [],
        count = [],
        i,
        number,
        max = 0;
    for (i = 0; i < ARRAY.length; i += 1) {
        number = ARRAY[i];
        count[number] = (count[number] || 0) + 1;
        if (count[number] > max) {
            max = count[number];
        }
    }
    for (i in count) if (count.hasOwnProperty(i)) {
        if (count[i] === max) {
            modes.push(Number(i));
        }
    }
    var result="";
    var x;
    for(x= modes.length-1; x>=0;x--){
        result=modes[x]+ " " + result;
    }
    return result;
}

function calcStdDev(ARRAY) {
    let variance = calcVariance(ARRAY);
    let std_dev = Math.sqrt(variance);
    return std_dev.toFixed(2);
}

function performStatistics() {
    let area = document.getElementById("textarea").value;
    area = area.trim();
    let strArray = area.split(" ");

    // pass a function to map
    const ARRAY = strArray.map(Number);

    document.getElementById("sum").value = calcSum(ARRAY);
    document.getElementById("max").value = findMax(ARRAY);
    document.getElementById("min").value = findMin(ARRAY);
    document.getElementById("mean").value = calcMean(ARRAY);
    document.getElementById("median").value = calcMedianARRAY(ARRAY);
    document.getElementById("variance").value = calcVariance(ARRAY);
    document.getElementById("mode").value = calcMode(ARRAY);
    document.getElementById("std_dev").value = calcStdDev(ARRAY);



    return false;

}