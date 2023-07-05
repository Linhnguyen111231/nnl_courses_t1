const eventPoint = document.querySelectorAll('.point')
const formc = document.querySelector('.form-c')
const tableC = document.querySelector('.tableC')
const checkAll = document.getElementById('checkall');
const checkList = document.querySelectorAll('.checklist');
const search =document.getElementById('search');
const add =document.getElementById('add');
const renderTable = document.getElementById('renderTB')
const loader = document.getElementsByClassName('loader')
search.addEventListener('keyup',(e)=>{
    searchKey(e.target.value);
})
async function searchKey(key) {
    renderTable.innerHTML='';

    renderTable.setAttribute('class','loader');
    const url = 'http://127.0.0.1:8000/api/getsearch';
    const data = {
        key: key
      };
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(data)
      });
      const result = await response.json();
      let render = ''
      result.search.forEach(e=>{
        render+=` <tr>
        <td> <input type="checkbox" class="checklist" name="checkall"></td>
        <td>${e.name}</td>
        <td>${e.description}</td>
        <td>1</td>
        <td>1</td>
        <td><button class="btn btn-primary">Edit</button> | <button class="btn btn-danger">Delete</button></td>
    </tr>`
      })
      
      renderTable.innerHTML = render
      renderTable.removeAttribute('class');

}
checkAll.addEventListener('click',(e)=>{
    if (e.target.checked) {
        checkList.forEach((el)=>{
            el.setAttribute('checked',true);
        })
    }else{
        checkList.forEach((el)=>{
            el.removeAttribute('checked')
        })
    }
})
eventPoint.forEach(e=>{
    e.addEventListener('click',(el)=>{
        eventPoint.forEach(em=>{
            em.classList.remove('active')
        })
        el.target.setAttribute('class','active list-group-item')
        switch (el.target.textContent) {
            case "Add":
                formc.style.display="block"
                tableC.style.display="none !impostant"

                break;
            case "Table":
                tableC.style.display="block"
                formc.style.display="none"

            break;
            default:
                break;
        }
    })
})
add.addEventListener('click',()=>{

})