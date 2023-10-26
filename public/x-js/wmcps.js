if( typeof wmcpsComponent == 'undefined' )
{
    const wmcpsComponent = {
        element: document.getElementById('wmcps-component'),
        listen: function () {
            this.element.addEventListener('click', () => {
                console.log('Clicked!')
            })
        }
    }
    wmcpsComponent.listen()
}
