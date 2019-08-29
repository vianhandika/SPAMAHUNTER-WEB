import  App  from './app'

export default {

    EventOn(event){
        if(event.verify==1){
            return true
        }
            return false
   
    },

    EventHighlight(event){
        if(event.highlight==1){
            return true
        }
            return false
    },
    
    //KATEGORI
    Seminar(event){
        if(event.type == 'Seminar')
        {
            return true 
        }
            return false
    },
    Workshop(event){
        if(event.type == 'Workshop')
        {
            return true 
        }
            return false
    },
    Social(event){
        if(event.type == 'Social')
        {
            return true 
        }
            return false
    },
    Contest(event){
        if(event.type == 'Contest')
        {
            return true 
        }
            return false
    },

    // userEvent(event){
    //     if(event.id_user == this.$auth.user().id )
    //     {
    //         return true 
    //     }
    //         return false
    // }

 
}

