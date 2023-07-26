function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
        break;
        }
    }
}
function formatCash(str) {
    return str.split('').reverse().reduce(
        (prev, next, index) => {
            return ((index % 3) ? next : (next + ',')) + prev
        }
    )
}

document.addEventListener("DOMContentLoaded",function(){
    document.querySelector('#inputRangePrice').onchange = function(){
        var priceRange = document.querySelector("#inputRangePrice").value;
        window.location.href = './products.php?changePrice='+priceRange+'';            
    }
    const img_destinyProduct = document.querySelectorAll('.destiny_product');
    
    img_destinyProduct.forEach((item,index) => {
        var destiny = (item.getAttribute('alt')).toString();
        if(destiny == "Hỏa"){
            item.style.background = '#f52121';
        }
        else if(destiny == "Kim"){
            item.style.background = '#f1c40f';
        }
        else if(destiny == "Thủy"){
            item.style.background = '#3498db';
        }
        else if(destiny == "Mộc"){
            item.style.background = '#2ecc71';
        }
        else{
            item.style.background = '#cd6133';
        }
    });
});
