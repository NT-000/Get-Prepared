import {writable} from "svelte/store";

export const currentUser = writable(null);
export const guest = writable(null)

export async function fetchGuestUser(){
    const res = await fetch('/api/login_guest', {
        method: 'GET',
      credentials: 'include'
    });
   const data = await res.json();
   if (data.success){
       guest.set({id: data.id, username: data.username, name: data.name});
   }else{
       guest.set(null)
   }
}

export async function fetchCurrentUser() {

    const res = await fetch('/api/logged_in_user', {
        method: 'GET',
      credentials: 'include',
    });
       const data = await res.json();
   if (data.success){
       currentUser.set({ id: data.id, username: data.username , name: data.name});
   } else {
       currentUser.set(null);
   }

}


