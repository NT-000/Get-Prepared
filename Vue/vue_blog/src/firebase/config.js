import { initializeApp } from "firebase/app";
import { getFirestore} from "firebase/firestore";

const firebaseConfig = {
  apiKey: "AIzaSyBpTGVpI04mgG0nBKeqQlPSsKdhXLhZPc8",
  authDomain: "the-blog-firebase.firebaseapp.com",
  projectId: "the-blog-firebase",
  storageBucket: "the-blog-firebase.firebasestorage.app",
  messagingSenderId: "391920365697",
  appId: "1:391920365697:web:c3b803f2038f82850a9d80",
  measurementId: "G-Q0S124QMCT"
};

const app = initializeApp(firebaseConfig);

const projectFirestore = getFirestore(app)



export { projectFirestore};
