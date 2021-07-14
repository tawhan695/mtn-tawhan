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
function addEnv(p_id,p_name,p_price) {
 var env = document.getElementById('additem');
         var divMain = document.createElement("div");
         var divName = document.createElement("div");
         var divCol = document.createElement("div");
         var pLeft = document.createElement("p");
         var pLeft_span = document.createElement("span");
         var pRight = document.createElement("p");
         var pRight_span = document.createElement("span");
         divMain.className ="list row  m-1 pb-0 border border-right-0 border-left-0 border-top-0"; 
         divMain.setAttribute("id", "ID"+p_id);
         divMain.setAttribute("onclick", "editQTY('"+p_id+"')");
         // divMain.setAttribute("data-target", "#pdModalCenter");
         
         divName.setAttribute("class", "col-12");
         divName.appendChild(document.createTextNode(p_name))
         divMain.appendChild(divName)
         divCol.setAttribute("class", "col-12");
         pLeft.setAttribute("class", "float-left");
         pLeft.appendChild(document.createTextNode(parseFloat(p_price).toFixed(2)+' '+'X'))
         pLeft_span.setAttribute("id", "count"+p_id);
         pLeft_span.appendChild(document.createTextNode('1'))
         pLeft.appendChild(pLeft_span);
         
         pRight.setAttribute("class", "float-right");
         pRight_span.setAttribute("id", "totol"+p_id);
         pRight.appendChild(document.createTextNode('฿'))
         pRight_span.appendChild(document.createTextNode(parseFloat(p_price).toFixed(2)))
         pRight.appendChild(pRight_span);
         divCol.appendChild(pLeft);
         divCol.appendChild(pRight);
         divMain.appendChild(divCol)
         var envProduct = document.getElementById('P'+p_id);
         var ps = document.createElement('span');
         ps.appendChild(document.createTextNode('1'))
         ps.setAttribute('id','amont'+p_id);
         ps.setAttribute('class','am rounded');
         envProduct.appendChild(ps);
         env.appendChild(divMain);
         
   
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
function editQTY(id) {
 //console.log($('#count'+id).text());
 Swal.fire({
             title: 'แก้ไขจำนวนสินค้า',
             input: 'number',
             // inputLabel: 'Your IP address',
             inputValue: parseInt($('#count'+id).text()),
             // html:'<input type="button" class="btn btn-danger btn-lg" onclick="moveList('+id+')" value="ลบออกจากรายการ">',
             showDenyButton: true,
             showCancelButton: true,
             denyButtonText: 'นำออก',
             confirmButtonText:'บันทึก',
             cancelButtonText:'ยกเลิก',
             inputValidator: (value) => {
                 if (!value) {
                 
                
                 }
             }
             }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
                 if (result.isConfirmed) {
                     var val =parseInt(result.value);
                    list.forEach((element,index) => {
                        if(list[index].id == id ){
                            list[index].qty = val;
                            list[index].totol = parseFloat(list[index].price) * parseInt(list[index].qty)
                                            // chang
                            $('#amont'+id).text(list[index].qty);
                            $('#count'+id).text(list[index].qty);
                            $('#totol'+id).text(parseFloat(list[index].totol).toFixed(2));
                            $('#totol').text(parseFloat(Totol.data).toFixed(2));
                        }
                    
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'บันทึกเรียบร้อย'+result.value
                        });
                        $('#totol').text(parseFloat(Totol.data).toFixed(2));    
                 } else if (result.isDenied) {
                     $('#ID'+id).remove();
                     $('#amont'+id).remove();
                     
                     // //console.log(list['id']);
                     var INDEX = 0;
                     var getID = '';
                     list.forEach(element => {
                         if(list[INDEX].id == id ){
                             list.pop(INDEX)
                         }
                         INDEX++;
                     });
                     //console.log(list);
                    //  list[INDEX]
                 

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
// //   function moveList(id) {
   
// //   }


var list=[]
var Totol = {
    get data(){
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
function ListProduct(id,name,price){
        this.id = id;
        this.name = name;
        this.price = parseFloat(price).toFixed(2);
        this.totol = parseFloat(price).toFixed(2);
        this.qty = 1;
    }


function AddItem(p_id,p_name,p_price) {
   var data  = new ListProduct(p_id,p_name,p_price);4
    if (list.length == 0) {
        list.push(data);
        addEnv(p_id,p_name,parseFloat(p_price).toFixed(2));
        $('#totol').text(parseFloat(Totol.data).toFixed(2));
        document.getElementById('sub').disabled = false;
    } else {
        var isHas = false;
        list.forEach((e, index) => {
            if (e.id == p_id) {
                list[index].qty += 1;
                list[index].totol = parseFloat(list[index].price) * parseInt(list[index].qty)
                isHas = true;

                // chang
                $('#amont'+p_id).text(list[index].qty);
                $('#count'+p_id).text(list[index].qty);
                $('#totol'+p_id).text(parseFloat(list[index].totol).toFixed(2));
                $('#totol').text(parseFloat(Totol.data).toFixed(2));
            } 
            //console.log(index,e.id);
            
        });
        
        if(isHas == false){
            list.push(data);
                addEnv(p_id,p_name,parseFloat(p_price).toFixed(2))
                $('#totol').text(parseFloat(Totol.data).toFixed(2));
       
            }      
    }
    //console.log(list);
    //console.log(Totol.data);
}

