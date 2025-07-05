export function crearSpan() {
  const span = document.createElement("span");
  span.className = "noVisible";
  span.textContent = "El formato no coincide";
  return span;
}
