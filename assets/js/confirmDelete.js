$(document).ready(() => {
    var param = window.location.href;
    const url = new URL(param);
    const searchParams = url.searchParams;

    param = searchParams.get('id');

    let res = confirm('Do you want to delete the Blog');
    if (res) {
        location.replace("./delete.php?id=" + param);
    } else {
        location.replace("./dashboard.php");
    }
})