document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.getElementById('loading').style.display= 'block';
        document.getElementById('main_content').style.display= 'none';
    } else {
        document.getElementById('loading').style.display= 'none';
        document.getElementById('main_content').style.display= 'block';
    }
};