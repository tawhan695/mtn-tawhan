// //console.log('hello market');

// var ModalEdit = document.getElementById('edit1');
// var ListB =  document.getElementsByClassName('list');
// for (var i = 0; i < ListB.length; i++){
//      ListB[i].onclick = function(){ Dialog(this.id) };
//  }
//  //edit product
// function Dialog(params) {
//    //console.log('this is'+ params);
//      ModalEdit.innerHTML = 'this is'+ params;
// }
// //add product
// var list =[];
// function AddItem(p_id,p_name,p_price) {

// }
//  //   //console.log('input  -- ','id ',p_id,'name',p_name,'price',p_price);
//    let item = {id:p_id,name:p_name,price:parseFloat(p_price).toFixed(2),totol:parseFloat(p_price).toFixed(2),qty:1};
//  //   //console.log('len',list.length);
//    if (list.length < 1) {

//      list.push(item);
//    } else {
//      let acc = false;
//      list.forEach((element,index) => {
//          //console.log(element.id,index);
//          if (element.id == p_id) {
//              list[index].qty  +=1;
//              list[index].totol =(parseFloat(list[index].price) * list[index].qty).toFixed(2);
//              acc = true;
//          } else {
//              if(acc == false){
//                  list.push(item);
//                  // acc = true;
//              }
//          }
//      });
//    }
//    //console.log(list);
//  //   if (list.length < 1) {
//  //         list.push({id:p_id,name:p_name,price:p_price,totol:parseFloat(p_price).toFixed(2),qty:1})
//  //         addEnv(p_id,p_name,parseFloat(p_price).toFixed(2))
//  //         Totol();
//  //         document.getElementById('sub').disabled = false;
//  // //   list.forEach(EditItem);
//  //   } else {

//  //   var index =0;
//  //   var same = -1;
//  //   var TOTOL = 0;
//  //   list.forEach(element => {

//  //     //   //console.log('index:'+index);
//  //       if (element.id == p_id) {

//  //         list[index].qty += 1;
//  //         var tp = parseFloat(element.price).toFixed(2) * parseInt(list[index].qty);
//  //         //console.log('vv ',$('#P'+p_id).length);
//  //         if($('#P'+p_id).length){
//  //             //console.log(''+list[index].qty);
//  //             $('#amont'+p_id).text(list[index].qty);
//  //         }else{
//  //             var envProduct = document.getElementById('P'+p_id);
//  //             var ps = document.createElement('span');
//  //             ps.appendChild(document.createTextNode(list[index].qty))
//  //             ps.setAttribute('id','amont'+p_id);
//  //             ps.setAttribute('class','am rounded');
//  //             envProduct.appendChild(ps);

//  //             $('P'+p_id).attr();

//  //         }
//  //         // $('#P'+p_id).text(list[index].qty);
//  //         // <span id="amont{{$product->id}}" class="am rounded" >1</span>
//  //         list[index].totol = tp;
//  //         // price
//  //         var id_to = "totol"+p_id;
//  //         document.getElementById(id_to).innerText =parseFloat(list[index].totol).toFixed(2);
//  //         //qty
//  //         var id_c = "count"+p_id;
//  //         document.getElementById(id_c).innerText =""+list[index].qty;
//  //         same = index;
//  //         Totol();
//  //       }

//  //       index+=1;

//  //         });
//  //     if(same == -1){
//  //         list.push({id:p_id,name:p_name,price:parseFloat(p_price).toFixed(2),totol:parseFloat(p_price).toFixed(2),qty:1});
//  //         addEnv(p_id,p_name,parseFloat(p_price).toFixed(2))
//  //         Totol();
//  //     }
//  //   }

// }
function addEnv(p_id, p_name, p_price, max_qty,img) {

const E =
`
<div class="list row  m-1 pb-0 border border-right-0 border-left-0 border-top-0" id="ID${p_id}"
    onclick="editQTY('${p_id}','${max_qty}')">
    <div class="col-2 image-list">
        <img class="image" style="width:80px; height:80px" src="${img}">
    </div>
    <div class="col-10 p-3">
        <div class="col-12">
            ${p_name}</div>
        <div class="col-12">
            <p class="float-left">${p_price} X<span id="count${p_id}">1</span></p>
            <p class="float-right">฿<span id="totol${p_id}">${p_price}</span></p>
        </div>
    </div>

</div>
`
$('#additem').append(E)

    // var env = document.getElementById('additem');
    // var divMain = document.createElement("div");
    // var divName = document.createElement("div");
    // var divCol = document.createElement("div");
    // var pLeft = document.createElement("p");
    // var pLeft_span = document.createElement("span");
    // var pRight = document.createElement("p");
    // var pRight_span = document.createElement("span");
    // divMain.className = "list row  m-1 pb-0 border border-right-0 border-left-0 border-top-0";
    // divMain.setAttribute("id", "ID" + p_id);
    // divMain.setAttribute("onclick", "editQTY('" + p_id + "','" + max_qty + "')");
    // // divMain.setAttribute("data-target", "#pdModalCenter");

    // divName.setAttribute("class", "col-12");
    // divName.appendChild(document.createTextNode(p_name))
    // divMain.appendChild(divName)
    // divCol.setAttribute("class", "col-12");
    // pLeft.setAttribute("class", "float-left");
    // pLeft.appendChild(document.createTextNode(parseFloat(p_price).toFixed(2) + ' ' + 'X'))
    // pLeft_span.setAttribute("id", "count" + p_id);
    // pLeft_span.appendChild(document.createTextNode('1'))
    // pLeft.appendChild(pLeft_span);

    // pRight.setAttribute("class", "float-right");
    // pRight_span.setAttribute("id", "totol" + p_id);
    // pRight.appendChild(document.createTextNode('฿'))
    // pRight_span.appendChild(document.createTextNode(parseFloat(p_price).toFixed(2)))
    // pRight.appendChild(pRight_span);
    // divCol.appendChild(pLeft);
    // divCol.appendChild(pRight);
    // divMain.appendChild(divCol)
    var envProduct = document.getElementById('P' + p_id);
    var ps = document.createElement('span');
    ps.appendChild(document.createTextNode('1'))
    ps.setAttribute('id', 'amont' + p_id);
    ps.setAttribute('class', 'am rounded');
    envProduct.appendChild(ps);
    // env.appendChild(divMain);


}
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
function editQTY(id, max_qty) {
    //console.log($('#count'+id).text());
    Swal.fire({
        title: 'แก้ไขจำนวนสินค้า',
        input: 'number',
        // inputLabel: 'Your IP address',
        inputValue: parseInt($('#count' + id).text()),
        // html:'<input type="button" class="btn btn-danger btn-lg" onclick="moveList('+id+')" value="ลบออกจากรายการ">',
        showDenyButton: true,
        showCancelButton: true,
        denyButtonText: 'นำออก',
        confirmButtonText: 'บันทึก',
        cancelButtonText: 'ยกเลิก',
        inputValidator: (value) => {
            if (value > parseInt(max_qty)) {
                return 'สินค้ามี ' + max_qty

            }
        }
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var val = parseInt(result.value);
            if (val > 0) {
                list.forEach((element, index) => {
                    if (list[index].id == id) {
                        list[index].qty = val;
                        list[index].totol = parseFloat(list[index].price) * parseInt(list[index].qty)
                        // chang
                        $('#amont' + id).text(list[index].qty);
                        $('#count' + id).text(list[index].qty);
                        $('#totol' + id).text(parseFloat(list[index].totol).toFixed(2));
                        $('#totol').text(parseFloat(Totol.data).toFixed(2));
                        // $('#mb-count').text(parseInt($('#mb-count').text())+val);
                        functionqty();
                    }

                });
                Toast.fire({
                    icon: 'success',
                    title: 'บันทึกเรียบร้อย' + result.value
                });
                $('#totol').text(parseFloat(Totol.data).toFixed(2));
            }
            else {
                functionDel(id);
            }
        } else if (result.isDenied) {

            //console.log(list);
            //  list[INDEX]
            functionDel(id);

            Toast.fire({
                icon: 'warning',
                title: 'นำออกจากรายการสำเร็จ'
            })
            $('#totol').text(parseFloat(Totol.data).toFixed(2));
            // ถ้าไม่มีรายการสินค้าให้ปิดปุ่ม ชำระเงิน
            if (list.length < 1) {
                document.getElementById('sub').disabled = true;
            }
        }
    })
}
async function functionqty() {
    var QQ = 0;
    await list.forEach((element, index) => {
        QQ += parseInt(element.qty)
    })
    $('#mb-count').text('' + QQ);
}
async function functionDel(id) {
    $('#ID' + id).remove();
    $('#amont' + id).remove();

    console.log(list);
    var INDEX = 0;
    var getID = '';
    await list.forEach((element, index) => {
        // const element = await fetch(e);
        if (list[index].id == id) {
            INDEX = index;
            // console.log(list[index].id);
            // console.log('id',id +'=');
            // // let qty = $('#mb-count').text();
            // console.log(list);
            // console.log('qty',parseInt( qty));
            // console.log('index',parseInt( list[index].qty));
            // $('#mb-count').text((parseInt( qty) - parseInt( list[index].qty)));
            // list.pop(index)
            functionqty();
            list.splice(index, 1);
            // console.log(list);

            // bmqty =parseInt($('#mb-count').text());

            // if($('#mb-count').text() == '0'){
            // }
            //  continue;
        }
        //  INDEX++;
    });
    functionqty();
}
// //   function moveList(id) {

// //   }


var list = []
var Totol = {
    get data() {
        let price = 0;
        list.forEach(element => {
            // //console.log('totol ',element.totol);
            price += parseFloat(element.totol);
            // //console.log('this.price ',price);
        });

        $('#Amout').text(parseFloat(price).toFixed(2));
        return parseFloat(price).toFixed(2)
    }

}
function ListProduct(id, name, price) {
    this.id = id;
    this.name = name;
    this.price = parseFloat(price).toFixed(2);
    this.totol = parseFloat(price).toFixed(2);
    this.qty = 1;
}

var bmqty = 0;
function AddItem(p_id, p_name, p_price, max_qty,img) {
    var data = new ListProduct(p_id, p_name, p_price);
    if (list.length == 0) {
        list.push(data);
        addEnv(p_id, p_name, parseFloat(p_price).toFixed(2), max_qty,img);
        $('#totol').text(parseFloat(Totol.data).toFixed(2));
        bmqty += 1;
        // $('#mb-count').text(bmqty);
        functionqty();
        document.getElementById('sub').disabled = false;
        console.log(list);
    } else {
        var isHas = false;
        var Mqty = 0
        list.forEach((e, index) => {
            if (e.id == p_id) {
                Mqty = list[index].qty
                if ( list[index].qty < parseInt(max_qty)) {
                    list[index].qty += 1;
                    list[index].totol = parseFloat(list[index].price) * parseInt(list[index].qty)
                    isHas = true;

                    // chang
                    $('#amont' + p_id).text(list[index].qty);
                    $('#count' + p_id).text(list[index].qty);
                    $('#totol' + p_id).text(parseFloat(list[index].totol).toFixed(2));
                    $('#totol').text(parseFloat(Totol.data).toFixed(2));
                    bmqty += 1;
                    // $('#mb-count').text(bmqty);
                    functionqty();
                }else{
                    Swal.fire(
                        'สินค้าหมดคลัง!',
                        'สินค้ามี '+ max_qty,
                        'question'
                      )
                }
                // $('#mb-count').text('X'+1+ '฿'+parseFloat(Totol.data).toFixed(2));
            }
            //console.log(index,e.id);
            // console.log(list);
        });

        if (isHas == false) {
            if (Mqty < parseInt(max_qty)) {
                bmqty += 1;
                list.push(data);

                addEnv(p_id, p_name, parseFloat(p_price).toFixed(2), max_qty,img)
                $('#totol').text(parseFloat(Totol.data).toFixed(2));
                // console.log(333);
                // $('#mb-count').text(bmqty);
                functionqty();
                // console.log(list);
            }
        }
    }
    //console.log(list);
    //console.log(Totol.data);
}

