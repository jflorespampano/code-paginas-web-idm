import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App.jsx'
import './index.css'
import { TablaPersonas } from './TablaPersonas.jsx'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <TablaPersonas />
    <App />
  </React.StrictMode>,
)
