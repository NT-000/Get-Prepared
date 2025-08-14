
export interface IVehicle {
    brand: string;
    price: number;
    drive(): void;
}

export interface IElectricVehicle extends IVehicle {
    battery: number;
    charge():void;
}