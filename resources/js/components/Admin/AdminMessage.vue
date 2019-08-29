<template>
  <div>
    <div id="contentadmin">
        <div class="tableeventadmin container w-100 ">
            <div class="mt-5">
                <span><div class="text-right infobtnrow">
                    <a href="#" class="btn btn-danger">✖</a><span> :  Delete </span>
                </div></span>
            </div>
        
            <div class="tablecontainer">
                <table class="table  table-striped table-bordered mt-2">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
         
                            
                         <tr v-for="(message,index) of allmessage.data" v-bind:key="index">
                            <td class="text-center">{{index+1}}</td>
                            <td>{{message.email}}</td>
                            <td>{{message.subject}}</td>
                            <td>{{message.message}}</td>
                            <td class="text-center actioncol">
                                <button @click="delmessage(message.id)"
                                class="btn btn-danger">✖</button>
                            </td>
                        </tr>
        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
import Controller from '../../httpController'
import Filter from '../../filter'

export default {
  data() {
        return{
            allmessage: [],
  
        }
    },
    methods:{
        async getallmessage () {
            try {
                this.allmessage = await Controller.getallmessage()
                this.allmessage.data = this.allmessage.data.reserve()

                console.log("Success Get All User")
                // console.log(this.alluser.data)
        
            } catch (err) {
                console.log(err)
            }
        },
        async delmessage (id) {
            try {
                await Controller.delmessage(id)

                console.log("Success Dell User")
                this.getallmessage()
            } catch (err) {
                console.log(err)
            }
        }

    },
    mounted(){
        this.getallmessage()
    }
}
</script>

