import { NavLink } from "react-router-dom"
export const NavBar = () => {
  return (
    <div className="w3-bar w3-border w3-light-grey">
        <NavLink to='/' className="w3-bar-item w3-button">Home</NavLink>
        <NavLink to='/mostrar' className="w3-bar-item w3-button">Mostrar</NavLink>
        <NavLink to='/altas' className="w3-bar-item w3-button">Altas</NavLink>
        <NavLink to='/buscar' className="w3-bar-item w3-button">Buscar</NavLink>
    </div>
  )
}
