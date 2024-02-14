<script>
class Checker
{
    toggle = false;

    checkbox_id_begin = null;

    id_trigger = null;

    constructor($checkbox_id_begin, $id_trigger = 'checkerButton')
    {
        this.checkbox_id_begin = $checkbox_id_begin;
        this.id_trigger = $id_trigger;
    }

    trigger() {
        return document.getElementById(this.id_trigger);
    }

    checkboxes() {
        return document.body.querySelectorAll(`input[type="checkbox"][id^="${this.checkbox_id_begin}"]`)
    }

    listen()
    {
        let self = this;

        if( this.trigger() )
        {
            this.trigger().addEventListener('click', function (evt)
            {
                evt.preventDefault()
    
                self.toggle = ! self.toggle;
                // self.trigger().classList.toggle('active', self.toggle)
                self.checkboxes().forEach(item => item.checked = self.toggle)
            })
        }
    }
}
</script>
