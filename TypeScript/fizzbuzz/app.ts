
enum FizzBuzzEnum {
    Fizz ,
    Buzz,
    FizzBuzz,
    Number
}

function fizzBuzz(num:number) : FizzBuzzEnum{
    if(num % 3 === 0 && num % 5 === 0){
        return FizzBuzzEnum.FizzBuzz;
    }
   if(num % 5 === 0){
       console.log(`${num} divided by 5 = ${num / 5}`)
        return FizzBuzzEnum.Buzz;
    }
    else if(num % 3 === 0){
        console.log(`${num} divided by 3 = ${num / 3}`)
        return FizzBuzzEnum.Fizz;
    }
    else{
        return FizzBuzzEnum.Number;
    }

}

for (let i = 1; i <= 30; i++) {

    const result : FizzBuzzEnum = fizzBuzz(i);
    if(result === FizzBuzzEnum.Number){
        console.log(i);
    }
    else{
        console.log(`${FizzBuzzEnum[result]}`);
    }
}
