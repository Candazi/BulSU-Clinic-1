const createMedicine = () => {
  let name = document.getElementById("name").value;
  let brand = document.getElementById("brand").value;
  let unit = document.getElementById("unit").value;
  let expiration = document.getElementById("expiration").value;
  let boxesCount = document.getElementById("boxesCount").value;
  let itemsCount = document.getElementById("itemsCount").value;

  let requestType = "createMedicine";

  const inventoryMessage = document.getElementById("inventoryMessage");

  axios
    .post(
      "./backend/routes/inventory.route.php",
      {
        name,
        brand,
        unit,
        expiration,
        boxesCount,
        itemsCount,
        requestType,
      },
      {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      }
    )
    .then(({ data }) => {
      const success = data.success;
      const message = data.message;
      inventoryMessage.innerText = message;
      getAllMedicine();
    })
    .catch((error) => {
      console.log(error);
    });
};

const getAllMedicine = () => {
  let requestType = "getAllMedicine";

  const tableBody = document.getElementById("tableBody");
  const tableMessage = document.getElementById("tableMessage");

  axios
    .get("./backend/routes/inventory.route.php", {
      params: {
        requestType,
      },
    })
    .then(({ data }) => {
      if (data.success) {
        while (tableBody.firstChild) {
          tableBody.removeChild(tableBody.firstChild);
        }
        const medicines = data.medicines;
        // Loop through each object in the medicines array
        medicines.forEach((item) => {
          // Create a new row (tr element) for each object
          const row = document.createElement("tr");

          // Loop through each key-value pair in the object
          for (const key in item) {
            if (item.hasOwnProperty(key)) {
              // Create a new cell (td element) for each value in the object
              const cell = document.createElement("td");
              cell.textContent = item[key];
              row.appendChild(cell);
            }
          }

          // Append the row to the table body
          tableBody.appendChild(row);
        });
        tableMessage.innerText = data.message;
      } else {
        tableMessage.innerText = data.message;
      }
    })
    .catch((error) => {
      console.log(error);
    });
};