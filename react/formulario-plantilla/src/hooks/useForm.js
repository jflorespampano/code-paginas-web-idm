import { useState } from "react"

export const useForm = (initialForm={}) => {
    const [formState,SetFormState]=useState({initialForm})

    const onInputChange=({target})=>{
        const {name, value}=target
        SetFormState({...formState,[name]:value})
        // console.log(target.name,"=",target.value)
    }
    return{
        formState,
        onInputChange
    }
}

