// I = 1, V=5, X = 10, L = 50, C = 100, D = 500, M = 1000

export const roman_values: Record<string, number> = {
    I: 1, V:5, X:10, L:50, C:100, D:500, M:1000
}

export function romanToInt(s: string): number {
    const string_upper = s.toUpperCase()
    let total = 0
    for (let i = 0; i < string_upper.length; i++) {
        const current = roman_values[string_upper[i]]
        const next_value = roman_values[string_upper[i +1]] ?? 0
        if(current < next_value) {
            total -= current
        }
        else{
            total += current
        }
    }
    return total
}

// const table: Array<Record<number, string>> = [
//     [1000, "M"], [900, "CM"], [500, "D"], [400, "CD"],
//     [100, "C"],  [90, "XC"],  [50, "L"],  [40, "XL"],
//     [10, "X"],   [9, "IX"],   [5, "V"],   [4, "IV"],
//     [1, "I"]
// ]

const number = romanToInt("MCMVIM")

console.log(number)