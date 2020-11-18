let search = async () => {
    let searchInput = document.querySelector('#country');
    let result = document.querySelector('#result')
    country = searchInput.value
    let res = await fetch(`world.php?country=${country}`);
    let data = await res.text()
    
    result.innerHTML = data;
}
window.addEventListener('load', () => {
    let btn = document.querySelector('#lookup');

    btn.addEventListener('click', () =>{
        search()
    })
})