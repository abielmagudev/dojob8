<script>
class Checker
{
    toggle = false;

    id_begin = null;

    id_button = null;

    constructor($id_begin, $id_button = 'checkerButton')
    {
        this.id_begin = $id_begin;
        this.id_button = $id_button;
    }

    trigger() {
        return document.getElementById(this.id_button);
    }

    checkboxes() {
        return document.body.querySelectorAll(`input[type="checkbox"][id^="${this.id_begin}"]`)
    }

    listen()
    {
        let self = this;

        this.trigger().addEventListener('click', function (evt)
        {
            evt.preventDefault()

            self.toggle = !self.toggle;
            self.trigger().classList.toggle('active', self.toggle)
            self.checkboxes().forEach(item => item.checked = self.toggle)
        })
    }
}
</script>
