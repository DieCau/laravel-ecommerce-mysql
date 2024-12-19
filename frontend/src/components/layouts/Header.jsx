import React from 'react'
import { useSelector } from 'react-redux'

export default function Header() {
  const { cartItems } = useSelector(state => state.cart)
  return (
    <div>
      Carrito({cartItems.length})
    </div>
  )
}
