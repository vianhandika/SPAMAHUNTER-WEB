import Http from './http'
// import store from './store'
// import Cookie from 'js-cookie'
// import Session from 'vue-session'

export default {
    authenticate (username, password) {
        return new Promise((resolve, reject) => {
            const payload = {
                username,
                password
            }

            const successCallback = (res) => {
                const user = res.data
                resolve()
            }

            const errorCallback = (err) => {
                reject(err)
            }


            Http.post('/auth/login', payload, successCallback, errorCallback)
        })
    },

    

    sendmessage (name, email, subject, message) {
        return new Promise((resolve, reject) => {
            const payload = {
                name,
                email,
                subject,
                message
            }

            const successCallback = (res) => {
                const inbox = res.data
                resolve()

            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/message', payload, successCallback, errorCallback)
        })
    },

    //EVENT AREA
    getallevent () {
        return new Promise((resolve, reject) => {
   
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/event', successCallback, errorCallback)
        })
    },
    geteventbyid (id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/event/'+id, successCallback, errorCallback)
        })
    },
    addevent(payload){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/event', payload , successCallback, errorCallback)
        })
    },
    verifyevent(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.patch('/event/verify/'+id ,id, successCallback, errorCallback)
        })
    },
    changehighlightevent(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.patch('/event/changehighlight/'+id ,id, successCallback, errorCallback)
        })
    },
    delevent(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const event = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.delete('/event/'+id , successCallback, errorCallback)
        })
    },

    //COMMENT AREA
    getcommentevent(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const comment = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/comment/event/'+id, successCallback, errorCallback)
        })
    },
    addcomment(payload){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const comment = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/comment', payload , successCallback, errorCallback)
        })
    },

    //USER AREA
    updatepicture(images,userid){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/user/uploadpicture/'+userid, images , successCallback, errorCallback)
        })
    },
    register (username, email, password) {
        return new Promise((resolve, reject) => {
            const payload = {
                username,
                email,
                password
            }

            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)

            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/user', payload, successCallback, errorCallback)
        })
    },
    deluser(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.delete('/user/'+id , successCallback, errorCallback)
        })
    },
    changeroleuser(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.patch('/user/changerole/'+id ,id, successCallback, errorCallback)
        })
    },
    getalluser(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/user', successCallback, errorCallback)
        })
    },
    getuser(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/user/'+id, successCallback, errorCallback)
        })
    },
    getuserbylogin(username)
    {
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/user/getuser/'+username, successCallback, errorCallback)
        })
    },

    //PROFILE AREA
    addprofile (id_user) {
        return new Promise((resolve, reject) => {
            const payload = {
                id_user
            }

            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)

            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.post('/profile', payload, successCallback, errorCallback)
        })
    },
    getprofile(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const message = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/profile/user/'+id, successCallback, errorCallback)
        })
    },
    updateprofile(payload,id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.patch('/profile/'+id, payload , successCallback, errorCallback)
        })
    },
    //MESSAGE AREA
    getallmessage(){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const message = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.get('/message', successCallback, errorCallback)
        })
    }, 
    delmessage(id){
        return new Promise((resolve, reject) => {
            
            const successCallback = (res) => {
                const user = res.data
                resolve(res.data)
            }

            const errorCallback = (err) => {
                reject(err)
    
            }

            Http.delete('/message/'+id , successCallback, errorCallback)
        })
    },





}