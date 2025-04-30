
var itemcounter1 = 1;

document.getElementById('adder-1').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-1').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-1').innerText;

    console.log(prodName);

 

    console.log(itemcounter1);

    let existingDiv = document.getElementById('cart-item-1');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter1}</h3></h4>`;
    } else {
        const div1 = document.createElement('div');
        div1.id = 'cart-item-1';
        div1.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div1.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter1}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div1);
    }

    itemcounter1++;

    

});


var itemcounter2 = 1;

document.getElementById('adder-2').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-2').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-2').innerText;

    console.log(prodName);

    console.log(itemcounter2);

    let existingDiv = document.getElementById('cart-item-2');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter2}</h3></h4>`;
    } else {
        const div2 = document.createElement('div');
        div2.id = 'cart-item-2';
        div2.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div2.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter2}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div2);
    }

    itemcounter2++;


});




var itemcounter3 = 1;

document.getElementById('adder-3').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-3').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-3').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter3);

    // const div3 = document.createElement('div');
    // div3.id = 'cart-item-3';
    // div3.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div3.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter3}</h3> </h4>
        
    // `

    // itemcounter3++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div3);


    let existingDiv = document.getElementById('cart-item-3');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter3}</h3></h4>`;
    } else {
        const div3 = document.createElement('div');
        div3.id = 'cart-item-3';
        div3.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div3.innerHTML = `<h5 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter3}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div3);
    }

    itemcounter3++;


});




var itemcounter4 = 1;

document.getElementById('adder-4').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-4').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-4').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter4);

    // const div4 = document.createElement('div');
    // div4.id = 'cart-item-4';
    // div4.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div4.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter4}</h3> </h4>
        
    // `

    // itemcounter4++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div4);


    let existingDiv = document.getElementById('cart-item-4');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter4}</h3></h4>`;
    } else {
        const div4 = document.createElement('div');
        div4.id = 'cart-item-4';
        div4.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div4.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter4}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div4);
    }

    itemcounter4++;


});




var itemcounter5 = 1;

document.getElementById('adder-5').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-5').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-5').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter5);

    // const div5 = document.createElement('div');
    // div5.id = 'cart-item-5';
    // div5.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div5.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter5}</h3> </h4>
        
    // `

    // itemcounter5++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div5);


    let existingDiv = document.getElementById('cart-item-5');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter5}</h3></h4>`;
    } else {
        const div5 = document.createElement('div');
        div5.id = 'cart-item-5';
        div5.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div5.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter5}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div5);
    }

    itemcounter5++;


});




var itemcounter6 = 1;

document.getElementById('adder-6').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-6').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-6').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter6);

    // const div6 = document.createElement('div');
    // div6.id = 'cart-item-6';
    // div6.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div6.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter6}</h3> </h4>
        
    // `

    // itemcounter6++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div6);


    let existingDiv = document.getElementById('cart-item-6');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter6}</h3></h4>`;
    } else {
        const div6 = document.createElement('div');
        div6.id = 'cart-item-6';
        div6.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div6.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter6}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div6);
    }

    itemcounter6++;


});




var itemcounter7 = 1;

document.getElementById('adder-7').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-7').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-7').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter7);

    // const div7 = document.createElement('div');
    // div7.id = 'cart-item-7';
    // div7.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div7.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter7}</h3> </h4>
        
    // `

    // itemcounter7++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div7);


    let existingDiv = document.getElementById('cart-item-7');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter7}</h3></h4>`;
    } else {
        const div7 = document.createElement('div');
        div7.id = 'cart-item-7';
        div7.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div7.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter7}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div7);
    }

    itemcounter7++;


});



var itemcounter8 = 1;

document.getElementById('adder-8').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-8').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-8').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter8);

    // const div8 = document.createElement('div');
    // div8.id = 'cart-item-8';
    // div8.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div8.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter8}</h3> </h4>
        
    // `

    // itemcounter8++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div8);


    let existingDiv = document.getElementById('cart-item-8');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter8}</h3></h4>`;
    } else {
        const div8 = document.createElement('div');
        div8.id = 'cart-item-8';
        div8.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div8.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter8}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div8);
    }

    itemcounter8++;


});



var itemcounter9 = 1;

document.getElementById('adder-9').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-9').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-9').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter9);

    // const div9 = document.createElement('div');
    // div9.id = 'cart-item-9';
    // div9.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div9.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter9}</h3> </h4>
        
    // `

    // itemcounter9++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div9);


    let existingDiv = document.getElementById('cart-item-9');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter9}</h3></h4>`;
    } else {
        const div9 = document.createElement('div');
        div9.id = 'cart-item-9';
        div9.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div9.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter9}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div9);
    }

    itemcounter9++;


});





var itemcounter10 = 1;

document.getElementById('adder-10').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-10').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-10').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter10);

    // const div10 = document.createElement('div');
    // div10.id = 'cart-item-10';
    // div10.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div10.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter10}</h3> </h4>
        
    // `

    // itemcounter10++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div10);


    let existingDiv = document.getElementById('cart-item-10');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter10}</h3></h4>`;
    } else {
        const div10 = document.createElement('div');
        div10.id = 'cart-item-10';
        div10.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div10.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter10}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div10);
    }

    itemcounter10++;


});




var itemcounter11 = 1;

document.getElementById('adder-11').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-11').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-11').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter11);

    // const div11 = document.createElement('div');
    // div11.id = 'cart-item-11';
    // div11.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div11.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter11}</h3> </h4>
        
    // `

    // itemcounter11++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div11);


    let existingDiv = document.getElementById('cart-item-11');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter11}</h3></h4>`;
    } else {
        const div11 = document.createElement('div');
        div11.id = 'cart-item-11';
        div11.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div11.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter11}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div11);
    }

    itemcounter11++;


});




var itemcounter12 = 1;

document.getElementById('adder-12').addEventListener('click', function(event){

    event.preventDefault();

    let counter = parseInt(document.getElementById('count').innerText);

    counter++;

    console.log(counter);

    document.getElementById('count').innerText = counter;

    const prodprice = parseInt(document.getElementById('adder-val-12').innerText);

    console.log(prodprice);


    const prodName = document.getElementById('item-name-12').innerText;

    console.log(prodName);

    
    
    

    console.log(itemcounter12);

    // const div12 = document.createElement('div');
    // div12.id = 'cart-item-12';
    // div12.classList.add('card-body','bg-danger', 'p-2','text-dark', 'bg-opacity-25','d-flex' ,'justify-content-center','text-center');
    // div12.innerHTML=`
    //     <h4 class = "fw-bold fs-5 fs-lg-3 text-center  ">${prodName} - ${prodprice} X <h3>${itemcounter12}</h3> </h4>
        
    // `

    // itemcounter12++;
    // // document.getElementById('cartitem').innerText = '';
    // document.getElementById('cartitem').appendChild(div12);


    let existingDiv = document.getElementById('cart-item-12');
    if (existingDiv) {
        existingDiv.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter12}</h3></h4>`;
    } else {
        const div12 = document.createElement('div');
        div12.id = 'cart-item-12';
        div12.classList.add('card-body', 'bg-danger', 'p-2', 'text-dark', 'bg-opacity-25', 'd-flex', 'justify-content-center', 'text-center');
        div12.innerHTML = `<h4 class="fw-bold fs-5 fs-lg-3 text-center">${prodName} - ${prodprice} X <h3>${itemcounter12}</h3></h4>`;
        document.getElementById('cartitem').appendChild(div12);
    }

    itemcounter12++;


});


