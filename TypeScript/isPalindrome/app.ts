
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

isPalindrome("hei")
isPalindrome("radar")
isPalindrome("madam")


