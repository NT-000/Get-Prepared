
function isPalindrome(text:string):void {
    let strBackwards: string = "";
    for(let i= text.length - 1; i >= 0; i--){
        strBackwards += text[i];
        console.log(strBackwards);
    }
if(text === strBackwards){
    console.log(`${text} is a palindrome`);
}
else console.log(`${text} is not a palindrome`);
}



function isPalindrome2(text:string):void {
    let strBackwards: string = text.split("").reverse().join("");
    console.log(text.split(""));
    console.log(text.split("").reverse());

    if(text === strBackwards){
        console.log(`${text} is a palindrome`);
    }
    else console.log(`${text} is not a palindrome`);
}

isPalindrome("hei")
isPalindrome2("hei")

isPalindrome("radar")
isPalindrome2("radar")

isPalindrome("madam")
isPalindrome2("madam")


