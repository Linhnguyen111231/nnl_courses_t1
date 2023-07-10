const eventPoint = document.querySelectorAll(".point");
const formc = document.querySelector(".form-c");
const tableC = document.querySelector(".tableC");
const formEdit = document.querySelector(".edit-item");
const checkAll = document.getElementById("checkall");
const search = document.getElementById("search");
const add = document.getElementById("add");
const renderTable = document.getElementById("renderTB");
const loader = document.getElementsByClassName("loader");
const dltAll = document.getElementById("btnAll");
const displaySc = document.querySelector(".n-sc");
const displayEr = document.querySelector(".n-er");
const successForm = document.querySelector(".success-form");
const errorForm = document.querySelector(".error-form");
const sortAZ = document.getElementById("sortAZ");
const sortZA = document.getElementById("sortZA");
const checkList = document.querySelectorAll(".checklist");
const pageURL = document.querySelector(".page-url");

let page = 1


let keySearch = ''
searchKey(keySearch,'');
 function processDelete() {
    const dltItem = document.querySelectorAll(".btnDelete");
    
    dltItem.forEach((element) => {
        element.addEventListener("click", (e) => {
            deleteItem(e.target.getAttribute('data-item'))
            
            
        });
    });
    

}
search.addEventListener("keyup", (e) => {
    keySearch = e.target.value
    searchKey(keySearch,'');
});
let sortB =''
sortAZ.addEventListener('click',(e)=>{
    sortB = 'increaseName'
    searchKey(keySearch,sortB)
})
sortZA.addEventListener('click',(e)=>{
    sortB = 'reduceName'

    searchKey(keySearch,sortB)

})
let arrCourses = [];
checkList.forEach((el) => {
    el.addEventListener("click", (e) => {
        const check = arrCourses.includes(
            parseInt(e.target.getAttribute("data-item"))
        );

        if (check) {
            arrCourses = arrCourses.filter(
                (item) => item !== parseInt(e.target.getAttribute("data-item"))
            );
        } else {
            arrCourses = [
                ...arrCourses,
                parseInt(e.target.getAttribute("data-item")),
            ];
        }
        console.log(arrCourses);
    });
});
async function deleteItem(item) {
    const url = "http://127.0.0.1:8000/api/delete/"+item;

    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    });
    const result = await response.json();
    

    console.log(result.success);
    
    if (result.success) {
    displaySc.style.display = "block";
        
    }else{
    displayEr.style.display = "block";

    }
    setTimeout(()=>{
    displaySc.style.display = "none";
    displayEr.style.display = "none";

    },3000)
    
    processDelete();
    searchKey(keySearch, sortB)
}
dltAll.addEventListener('click',()=>{
    deleteArr(arrCourses)
})
async function deleteArr(arr) {
    const url = "http://127.0.0.1:8000/api/delete/all";
    const data = {
        arr: arr
    };
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify(data),

    });
    const result = await response.json();
    
    
    if (result.success) {
    displaySc.style.display = "block";
        
    }else{
    displayEr.style.display = "block";

    }
    setTimeout(()=>{
    displaySc.style.display = "none";
    displayEr.style.display = "none";

    },3000)

    
    processDelete();
    searchKey(keySearch, sortB)
}
async function searchKey(key,sort) {
    renderTable.innerHTML = "";

    renderTable.setAttribute("class", "loader");
    const url = "http://127.0.0.1:8000/api/getsearch";
    const data = {
        key: key,
        sort: sort,
        page: page
    };
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify(data),
    });
    const result = await response.json();
    let render = "";
    result.search.data.forEach((e) => {
        render += ` <tr>
        <td> <input type="checkbox" ${checkAll.getAttribute('checked')?'checked': ''} class="checklist" name="checkall"></td>
        <td>${e.name}</td>
        <td>${e.description}</td>
        <td>${e.startdate}</td>
        <td>${e.enddate}</td>
        <td style="white-space: nowrap"><button class="btn btnEdit btn-primary">Edit</button> | <button data-item="${e.id}" class="btn btn-danger btnDelete">Delete</button></td>
    </tr>`;
    });
    let rederURL = ''
    let number = 0;
    const totalPage = result.search.last_page
    for (let i = page; i <= totalPage; i++) {
        number = i;
        if (page-1 !=0) {
            rederURL+= `<li class="rounded-circle page"><span>Pre</span></li>`
        }
        if (page == 1) {
            rederURL+=`
            <li class="rounded-circle page ${page==1?'active' : ''}"><span>${1}</span></li>`
        }else
            if (i-1 >0) {
            
            rederURL+=`
            <li class="rounded-circle page "><span>${i-1}</span></li>`
        }
        if (number <= totalPage) {
            rederURL +=
            `<li class="rounded-circle page ${page!=1?'active' : ''}"><span>${(page == 1)? number+1: number}</span></li>`
            if (number + 1  <=totalPage) {
                rederURL+=
                `<li class="rounded-circle page"><span>${(page == 1)? number+1+1: number+1}</span></li>`
                if (number + 1 + 1 <=totalPage) {
                    rederURL+=
                    `<li class="rounded-circle page"><span>Next</span></li>`
                }
            }
        }
        pageURL.innerHTML = rederURL
        break
    }
    renderTable.innerHTML = render;
    renderTable.removeAttribute("class");
    processDelete();
    const listPage = document.querySelectorAll('.page')
    console.log(listPage);
    listPage.forEach(e=>{
        e.addEventListener('click',el=>{
            if (el.target.textContent == 'Next') {
                page+=1
                searchKey(keySearch,sortB)

            }else if (el.target.textContent == 'Pre' && page-1!=0) {
                page-=1
                searchKey(keySearch,sortB)
                
            }else{

                page = parseInt(el.target.textContent)
                    searchKey(keySearch,sortB)
            }
        })
    })
    const edit = document.querySelectorAll('.btnEdit')
    const cancel = document.getElementById('cancelEdit')
    edit.forEach((e)=>{
        e.addEventListener('click',(el)=>{
           
            formEdit.style.display ='block'
            cancel.addEventListener('click',()=>{
                formEdit.style.display = 'none'
            })
        })
    })
    

}
checkAll.addEventListener("click", (e) => {
const checkL = document.querySelectorAll('.checklist')
    if (e.target.checked) {
        arrCourses = [];

        checkL.forEach((el) => {
            el.setAttribute("checked", true);
            arrCourses = [
                ...arrCourses,
                parseInt(el.getAttribute("data-item")),
            ];
        });
    } else {
        checkL.forEach((el) => {
            el.removeAttribute("checked");
            arrCourses = [];
        });
    }
    console.log(arrCourses);
    console.log(arrCourses);
});
eventPoint.forEach((e) => {
    e.addEventListener("click", (el) => {
        eventPoint.forEach((em) => {
            em.classList.remove("active");
        });
        el.target.setAttribute("class", "active list-group-item");
        switch (el.target.textContent) {
            case "Add":
                formc.style.display = "block";
                tableC.style.display = "none";
                formEdit.style.display = "none";

                break;
            case "Table":
                tableC.style.display = "block";
                formc.style.display = "none";
                formEdit.style.display = "none";

                break;
            default:
                break;
        }
    });
});
add.addEventListener("click", (e) => {
    e.preventDefault();
    addcourses()
});
async function addcourses() {
    const description = document.querySelector('#desciption').value;
    const data = document.querySelectorAll('input[name]:not([type="checkbox"]):not([type="radio"])')


    const url = "http://127.0.0.1:8000/api/add-course";
    const dataSV = {
        name: data[1].value,
        description: description,
        startdate: data[2].value,
        enddate: data[3].value,
    };
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
        body: JSON.stringify(dataSV),
    });
    const result = await response.json();
    if (result.result == true) {
        successForm.style.display = 'block'
        const sokay = document.querySelector('.s-okay')
        const sctn = document.querySelector('.s-ctn')
        sokay.addEventListener('click',()=>{
            window.location.href = '/';
        })
        sctn.addEventListener('click',()=>{
         successForm.style.display = 'none'

        })
    }else{
        errorForm.style.display = 'block'
    const inforEr = document.querySelectorAll('.error-text') 
        console.log(result.validate.name);
        console.log(result.validate);
        if (result.validate.name) {
            inforEr[0].innerText = result.validate.name[0];
            
        }
        if (result.validate.startdate) {
            inforEr[1].innerText = result.validate.startdate[0];
            
        }
        if (result.validate.enddate) {
            inforEr[2].innerText = result.validate.enddate[0];
            
        }
        if (result.validate.description) {
            inforEr[3].innerText = result.validate.description[0];
            
        } 
        
        const erctn = document.querySelector('.er-ctn')
        erctn.addEventListener('click',()=>{
            errorForm.style.display = 'none'
   
           })
    }
}
function btnEvent(event) {
    
}
