(function(){
const url='https://openlibrary.org/search.json?q=';

window.addEventListener('load',init);


function init(){
    let catGun='045149492';
    let fables='9780140446494';
    id('isbn').addEventListener('input',()=>{
        let isbn= id('isbn').value;
        
        if(isbn.length>=9)
            isbnLookup(isbn);
    });
    //isbnLookup(catGun);
}

function isbnLookup(isbn){
    fetch(url+isbn)
    .then(checkResponse)
    .then(function(response){
        if(response.docs[0])
            return response.docs[0];
        else
            return {'errMsg':'No book Found for that ISBN'};
    })
    .then(function(book){
        if(book.hasOwnProperty('errMsg')){
            id('apiErr').innerHTML=book.errMsg;
        }
        else{
            //console.log(book);
            id('title').value=book.title;
            if(book.hasOwnProperty('author_name'))
                id('author').value=book.author_name[0];
            else{
                let contributors=book.contributor[0];
                for(let i=1;i<book.contributor.length;i++)
                    contributors+= ", "+book.contributor[i];
                id('author').value=contributors;
            }
            id('year').value=book.first_publish_year;
            id('apiErr').innerHTML='';
        }
    })
    .catch(console.log)
    ;
}

function checkResponse(response){
    if(response.ok)
        return response.json();
    else
        return {errMsg:'Error getting book'};
}

function id(identifier){
    return document.getElementById(identifier);
}

})();