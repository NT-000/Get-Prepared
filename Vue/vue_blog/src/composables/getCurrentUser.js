import {onMounted, ref} from "vue";
import {projectAuth, projectFirestore} from "@/firebase/config.js";
import { onAuthStateChanged } from "firebase/auth";
import {doc, getDoc} from "firebase/firestore";

const currentUser = ref(null);

const getCurrentUser = async () => {
  const user = projectAuth.currentUser;
  if(user){
    const userDoc = await getDoc(doc(projectFirestore, "users", user.uid));
    if(userDoc.exists()){
      currentUser.value = {
        uid: user.uid,
        email: user.email,
        ...userDoc.data()
      };
    }
    else{
      console.log('doc dont exist');
    }
  }else{
    currentUser.value = null;
  }
}
onAuthStateChanged(projectAuth, (user)=>{
  console.log('CurrentUser is:',user)
    getCurrentUser(user);
})




export default () =>{
  return {currentUser}
}

