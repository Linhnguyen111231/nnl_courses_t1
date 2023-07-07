const eventPoint = document.querySelectorAll(".point");
const formc = document.querySelector(".form-c");
const tableC = document.querySelector(".tableC");
const checkAll = document.getElementById("checkall");
const checkList = document.querySelectorAll(".checklist");
const search = document.getElementById("search");
const add = document.getElementById("add");
const renderTable = document.getElementById("renderTB");
const loader = document.getElementsByClassName("loader");
const dltAll = document.getElementById("btnAll");
const displaySc = document.querySelector(".n-sc");
const displayEr = document.querySelector(".n-er");
processDelete();
function processDelete() {
    const dltItem = document.querySelectorAll(".btnDelete");
    console.log(dltItem);
    dltItem.forEach((element) => {
        element.addEventListener("click", (e) => {
            deleteItem(e.target.getAttribute('data-item'))
            
            
        });
    });
}
search.addEventListener("keyup", (e) => {
    searchKey(e.target.value);
});

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
    let render = "";
    renderTable.innerHTML = "";

    result.courses.forEach((e) => {
        render += ` <tr>
        <td> <input type="checkbox" class="checklist" name="checkall"></td>
        <td>${e.name}</td>
        <td>${e.description}</td>
        <td>1</td>
        <td>1</td>
        <td><button class="btn btn-primary">Edit</button> | <button data-item="${e.id}" class="btn btn-danger btnDelete">Delete</button></td>
    </tr>`;
    });
    if (result.success) {
    displaySc.style.display = "block";
        
    }else{
    displayEr.style.display = "block";

    }
    setTimeout(()=>{
    displaySc.style.display = "none";
    displayEr.style.display = "none";

    },3000)
    renderTable.innerHTML = render;
    processDelete();
}
async function searchKey(key) {
    renderTable.innerHTML = "";

    renderTable.setAttribute("class", "loader");
    const url = "http://127.0.0.1:8000/api/getsearch";
    const data = {
        key: key,
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
    result.search.forEach((e) => {
        render += ` <tr>
        <td> <input type="checkbox" class="checklist" name="checkall"></td>
        <td>${e.name}</td>
        <td>${e.description}</td>
        <td>1</td>
        <td>1</td>
        <td><button class="btn btn-primary">Edit</button> | <button data-item="${e.id}" class="btn btn-danger btnDelete">Delete</button></td>
    </tr>`;
    });

    renderTable.innerHTML = render;
    renderTable.removeAttribute("class");
    processDelete();
}
checkAll.addEventListener("click", (e) => {
    if (e.target.checked) {
        arrCourses = [];

        checkList.forEach((el) => {
            el.setAttribute("checked", true);
            arrCourses = [
                ...arrCourses,
                parseInt(el.getAttribute("data-item")),
            ];
        });
    } else {
        checkList.forEach((el) => {
            el.removeAttribute("checked");
            arrCourses = [];
        });
    }
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

                break;
            case "Table":
                tableC.style.display = "block";
                formc.style.display = "none";

                break;
            default:
                break;
        }
    });
});
add.addEventListener("click", () => {});
