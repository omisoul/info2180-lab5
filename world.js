let search = async (isCitiesLookup) => {
    let searchInput = document.querySelector('#country');
    let result = document.querySelector('#result')
    country = searchInput.value
    let res = '';
    let data = '';
    if(isCitiesLookup){
        res = await fetch(`world.php?country=${country}&context=cities`);
        data = await res.text()
    }else{
        res = await fetch(`world.php?country=${country}&context=country`);
        data = await res.text()
    }
    
    result.innerHTML = data;
}
window.addEventListener('load', () => {
    let btn = document.querySelector('#lookup');
    let citBtn = document.querySelector('#cities');
    btn.addEventListener('click', () =>{
        search(false)
    })

    citBtn.addEventListener('click', () =>{
        search(true)
    })
})