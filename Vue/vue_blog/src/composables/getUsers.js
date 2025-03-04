import {projectFirestore} from "@/firebase/config.js";
import {ref} from "vue";
import {collection, onSnapshot, query} from "firebase/firestore";
import router from "@/router/index.js";

const getUsers = () => {
  const users = ref([])


  const load = async () => {

    const postsQuery = query(collection(projectFirestore, "users"));

    onSnapshot(postsQuery, (snapshot) => {
      users.value = snapshot.docs.map((doc) => ({
        ...doc.data(),
        id: doc.id,
      }));
    }, (error) => {
      console.error("users updates error:", error);
    });
  }
  return {users,load}
}

export default getUsers
