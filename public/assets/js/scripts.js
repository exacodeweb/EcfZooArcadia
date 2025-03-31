document.addEventListener('DOMContentLoaded', () => {
  const serviceList = document.getElementById('services-list');
  const addServiceForm = document.getElementById('add-service-form');

  // Charger la liste des services
  const loadServices = async () => {
      try {
          const response = await fetch('../get-services.php');
          const services = await response.json();

          serviceList.innerHTML = '';
          services.forEach(service => {
              const li = document.createElement('li');
              li.textContent = `${service.nom}: ${service.description}`;
              serviceList.appendChild(li);
          });
      } catch (error) {
          console.error('Erreur lors du chargement des services:', error);
      }
  };

  // Ajouter un service
  addServiceForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      const formData = new FormData(addServiceForm);

      try {
          const response = await fetch('../add-service.php', {
              method: 'POST',
              body: formData,
          });

          if (response.ok) {
              alert('Service ajouté avec succès !');
              addServiceForm.reset();
              loadServices();
          } else {
              alert('Erreur lors de l\'ajout du service.');
          }
      } catch (error) {
          console.error('Erreur lors de l\'ajout du service:', error);
      }
  });

  // Charger les services au démarrage
  loadServices();
});