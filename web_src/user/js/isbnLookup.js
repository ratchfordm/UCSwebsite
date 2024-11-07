(function(){
const url='https://api2.isbndb.com/book/';
const headers={
    "Content-Type":'application/json',
    "Authorization":'TODO REPLACE WITH REST KEY'
};
window.addEventListener('load',init);


function init(){
    let isbn='045149492X';
    fetch(url+isbn,{headers:headers})
    .then(console.log)
    .catch(console.log)
    ;
}


})();