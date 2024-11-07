
( function (){
    window.addEventListener('load',init);

    function init(){
        document.getElementById('user_password1').addEventListener('click',eraseErr);
        document.getElementById('user_password2').addEventListener('click',eraseErr);
    }

    function eraseErr(){
        document.getElementById('passErr').innerHTML='';
    }

})();


function passwordsMatch(){
    let pass1=document.getElementById('user_password1').value;
    let pass2=document.getElementById('user_password2').value;
    if(pass1==pass2)
        return true;
    document.getElementById('passErr').innerHTML='Passwords Must Match';
    return false;
}