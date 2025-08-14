import {IElectricVehicle} from './IVehicle';

export class BYD implements IElectricVehicle {
    brand: string;
    price: number;
    battery: number;

    constructor(brand: string, price: number, battery: number) {
        this.brand = brand;
        this.price = price;
        this.battery = Math.max(0, Math.min(100, battery));

    }

    drive(): void {
        if(this.battery === 0){
            console.log("battery is empty");
            this.charge()
        }
        else if(this.battery > 0 && this.battery <= 50){
            console.log(`**Starts**, but you should charge, battery at ${this.battery}%`);
            this.battery -=50;
        }
        else if(this.battery > 50 && this.battery <= 100){
            console.log(`**Starts**, you have plenty of battery, battery at ${this.battery}%`);
            this.battery -=50;
        }
    }

    charge(): void {
        if(this.battery <= 0){
            console.log(`Charging 50%, battery at ${this.battery + 50}%`);
        }
    }
}