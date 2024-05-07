import { useState } from 'react'
import {datos} from './helpers/getData.js'
export const TablaPersonas = () => {
    const [data,setData]=useState(datos)
    const filtraDatos=()=>{
        const nvaData=data.filter(v=>{
            if(v.edad>=18) return true
        })
        setData(nvaData)
    }
    const todos=()=>{
        setData(datos)
      }
  return (
    <div>TablaPersonas
        <table>
            <thead>
                <tr>
                    <td>id</td>
                    <td>nombre</td>
                    <td>edad</td>
                </tr>
            </thead>
            <tbody>
                {data.map(d=>{
                    return(
                        <tr key={d.id}>
                            <td>{d.id}</td>
                            <td>{d.nombre}</td>
                            <td>{d.edad}</td>
                        </tr>
                    )
                })}
            </tbody>
        </table>
        <button onClick={filtraDatos}>Filtrar</button>
        <button onClick={todos}>todos</button>
    </div>
  )
}
