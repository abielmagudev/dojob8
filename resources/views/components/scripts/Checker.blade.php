<script>
class Checker
{
    toggle = false;

    checkbox_name_begins = null;

    trigger_id = null;

    constructor($checkbox_name_begins, $trigger_id = 'checkerButton')
    {
        this.checkbox_name_begins = $checkbox_name_begins;
        this.trigger_id = $trigger_id;
    }

    trigger() {
        return document.getElementById(this.trigger_id);
    }

    checkboxes() {
        return document.body.querySelectorAll(`input[type="checkbox"][name^="${this.checkbox_name_begins}"]`)
    }

    listen()
    {
        let self = this;

        if( this.trigger() )
        {
            ['click', 'touchstart', 'pointerdown'].forEach(function (event) {
                self.trigger().addEventListener(event, function (evt)
                {
                    evt.preventDefault()
        
                    self.toggle = ! self.toggle;
                    self.checkboxes().forEach(item => item.checked = self.toggle)
                    // self.trigger().classList.toggle('active', self.toggle)
                })
            })
        }
    }
}
</script>
