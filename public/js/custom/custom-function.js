function get_abbr_from_string(str) {

    var str = str.replace(/  +/g, ' ');

    str = str.split(" ");

    for (var i = 0, x = str.length; i < x; i++) {
        str[i] = str[i][0].toUpperCase()
    }

    random = Math.floor(1000 + Math.random() * 9000);

    if(str.length > 20) str = str.substring(0,20);

    return random + '-' + str.join("");
}
