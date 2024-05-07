import { useState } from 'react'
import {datos} from './helpers/getData.js'

function App() {
  const [data, setData] = useState(datos)
  const filtra=()=>{
    const d=data.filter(d=>{
      if(d.edad>15) return true
    })
    setData(d)
  }
  const todos=()=>{
    setData(datos)
  }
  return (
    <div className='container'>
      <button onClick={filtra}>15 o mas</button>
      <button onClick={todos}>todos</button>
      {data.map(d=>{
        return(
          <div key={d.id} className='panel'>
            <h3>{d.nombre}</h3>
            <div className='contenido'>Su edad es: {d.edad}</div>
          </div>
        )
      })}
    </div>
  )
}

export default App
