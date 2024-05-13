let fetchbutton=document.getElementById('fetchBtn');
fetchbutton.addEventListener('click',fetchcall);

function fetchcall(){

    console.log("Fetch button clicked...");

    xhr= new XMLHttpRequest();
    xhr.open('GET','new.txt',true);
    // xhr.getResponseHeader('Content-type','application/json');

    xhr.onprogress=function(){
        console.log('Loading');
    }

    xhr.onload=function(){

        console.log(this.responseText);
    }
    console.log("Bie");
    xhr.send();
}

let popbutton=document.getElementById('popBtn');
popbutton.addEventListener('click',popcall);

function popcall(){
    console.log("Pop button is pressed...")

    xhr=new XMLHttpRequest();
    xhr.open('POST','https://dummy.restapiexample.com/api/v1/create',true);
    xhr.getResponseHeader('Content-Type: application/json');

    xhr.onprogress=function(){
       console.log('Uploading') ;
    }

    xhr.onload=function(){
        if(this.status === 200){
            console.log(this.responseText);
        }
        else{
            console.log("Some error occured")
        }
    }
    params=`{"name":"test","salary":"123","age":"23"}`
    xhr.send(params);
}