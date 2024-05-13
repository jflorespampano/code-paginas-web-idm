import { useState } from "react"

export const AltaPersona = () => {
    const [formState,SetFormState]=useState({
        first:"juan",
        last:"perez"
    })
    const {first, last}=formState
    const onInputChange=({target})=>{
        const {name, value}=target
        SetFormState({...formState,[name]:value})
        // console.log(target.name,"=",target.value)
    }
    const onSubmit=(event)=>{
        event.preventDefault()
        console.log(formState)
    }
  return (
    <form className="w3-container" onSubmit={onSubmit}>
        <p>      
        <label className="w3-text-brown"><b>First Name</b></label>
        <input 
            className="w3-input w3-border w3-sand" 
            name="first" 
            type="text"
            value={first}
            onChange={(event)=>{onInputChange(event)}}
        /></p>
        <p>      
        <label className="w3-text-brown"><b>Last Name</b></label>
        <input 
            className="w3-input w3-border w3-sand" 
            name="last" 
            type="text"
            value={last}
            onChange={onInputChange}
        /></p>
        <p>
        <button type="submit" className="w3-btn w3-brown">Submit</button></p>
    </form>
  )
}
