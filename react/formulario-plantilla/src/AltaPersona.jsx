import { useForm } from "./hooks/useForm"

export const AltaPersona = () => {
    const initialForm={
        first:"",
        last:"perez",
        email:""
    }
    const {formState, onInputChange}=useForm(initialForm)
    const {first, last, email}=formState

    const onSubmit=(event)=>{
        event.preventDefault()
        console.log(formState)
    }
  return (
    <form className="w3-container" onSubmit={onSubmit}>
        <div className="w3-panel">
            <label className="w3-text-brown"><b>First Name</b></label>
            <input 
                className="w3-input w3-border w3-sand" 
                name="first" 
                type="text"
                value={first}
                onChange={(event)=>{onInputChange(event)}}
            />
        </div>
        
        <div className="w3-panel">
            <label className="w3-text-brown"><b>Last Name</b></label>
            <input 
                className="w3-input w3-border w3-sand" 
                name="last" 
                type="text"
                value={last}
                onChange={onInputChange}
            />
        </div>
        <div className="w3-panel">
            <label className="w3-text-brown"><b>email</b></label>
            <input 
                className="w3-input w3-border w3-sand" 
                name="email" 
                type="email"
                value={email}
                onChange={onInputChange}
            />
        </div>
        <div className="w3-panel">
            <button type="submit" className="w3-btn w3-brown">Submit</button>
        </div>
    </form>
  )
}
