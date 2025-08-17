
type Circle = {
    radius: number;
}

type Square = {
    length: number;
}

type Shape = Circle | Square

const circle : Circle = {radius: 10}
const square : Shape = {length: 5}

function getArea(shape:Shape): number {
    if ("radius" in shape) {
        return Math.PI * shape.radius * shape.radius;
    }
    else if("length" in shape) {
        return shape.length * shape.length;
    }

}

getArea(circle);
getArea(square);

console.log(getArea(circle));
console.log(getArea(square));