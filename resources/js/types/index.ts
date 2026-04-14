export interface PowerStats {
    intelligence: number
    strength: number
    speed: number
    durability: number
    power: number
    combat: number
}

export interface Biography {
    fullName: string
    alterEgos: string
    aliases?: string[]
    placeOfBirth?: string
    firstAppearance: string
    publisher: string
    alignment: string
}

export interface Appearance {
    gender: string
    race: string
    heightImperial: string
    heightMetric: string
    weightImperial: string
    weightMetric: string
    eyeColor: string
    hairColor: string
}

export interface Work {
    occupation: string
    base: string
}

export interface Connections {
    groupAffiliation: string
    relatives: string
}

export interface SuperHero {
    id: string
    name: string
    powerStats?: PowerStats
    biography?: Biography
    appearance?: Appearance
    work?: Work
    connections?: Connections
    imageUrl?: string | null
}
