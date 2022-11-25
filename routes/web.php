<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\FabriquantController;
use App\Http\Controllers\BonDeRetourController;
use App\Http\Controllers\BonDeSortieController;
use App\Http\Controllers\CompteRenduController;
use App\Http\Controllers\EmplMachineController;
use App\Http\Controllers\CarteControleController;
use App\Http\Controllers\OutilDeMesureController;
use App\Http\Controllers\BonDeValidationController;
use App\Http\Controllers\LocalisationMachineController;
use App\Http\Controllers\TypeDeOutilDeMesureController;
use App\Http\Controllers\FicheDeControleTotaleController;
use App\Http\Controllers\OrdreDeTravailDeMesureController;
use App\Http\Controllers\OrdreDeTestDeValidationController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\PauseController;
use App\Http\Controllers\employeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\pointageController;
use App\Http\Controllers\heuresuppController;
use App\Http\Controllers\jourFerieController;
use App\Http\Controllers\ProbabiliteController;
use App\Http\Controllers\ConsommationController;
use App\Http\Controllers\InterServiceController;
use App\Http\Controllers\IntraServiceController;
use App\Http\Controllers\NomenclatureController;
use App\Http\Controllers\NoteAssiduiteController;
use App\Http\Controllers\PrevisionVenteController;
use App\Http\Controllers\TableauBordPieController;
use App\Http\Controllers\CapaciteMachineController;
use App\Http\Controllers\CalculChargesController;
use App\Http\Controllers\GammeController;
use App\Http\Controllers\OutilFabricationController;
use App\Http\Controllers\PointageEffectueController;
use App\Http\Controllers\PointageAEffectuerController;
use App\Http\Controllers\PonctualitePersonnelleController;
use App\Http\Controllers\TableauBordAideDecisionController;
use App\Http\Controllers\NoteProbabiliteJournaliereController;
use App\Http\Controllers\PonctualitePersonnelleTotalController;
use App\Http\Controllers\PonctualitePersonnelleAnnuelleController;
use App\Http\Controllers\PonctualitePersonnelleMensuelleController;
use App\Http\Controllers\PonctualitePersonnelleJournaliereController;
use App\Http\Controllers\AccueilController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//les routes de authentification_inscription
Route::get('/', function () {
    return view('index');
});

Route::get('/accueil',[AccueilController::class,"AccueilView"])->name("accueil.affiche");
Route::get('/deconnection',[AccueilController::class,"indexView"])->name("dec.affiche");

//les routes de fabriquant
Route::get('/ListeFabriquants',[FabriquantController::class,"ListeFabriquants"])->name('ListeFabriquants.affiche');
Route::get('/AjoutFabriquant',[FabriquantController::class,"AjoutUnFabriquant"])->name('AjoutFabriquant.affiche');
Route::post('/AjoutFabriquant',[FabriquantController::class,"store"])->name("AjoutFabriquant.Ajouter");
Route::delete('/ListeFabriquants/{NomFabriquant:fabriquant}',[FabriquantController::class,"delete"])->name("Fabriquant.Supprimer");
Route::get('/ModifierUnFabriquant/{NomFabriquant:fabriquant}',[FabriquantController::class,"ModifierFabriquant"])->name("Fabriquant.modifier");
Route::put('/ModifierUnFabriquant/{NomFabriquant:fabriquant}',[FabriquantController::class,"update"])->name("Fabriquant.update");

//les routes de type outil de mesure
Route::get('/ListeTypeOutil',[TypeDeOutilDeMesureController::class,"ListeTypeOutilDeMesure"])->name('ListeTypeOutil.affiche');
Route::get('/AjoutTypeOutil',[TypeDeOutilDeMesureController::class,"AjoutUnTypeDeOutilDeMesure"])->name('AjoutTypeOutil.affiche');
Route::post('/AjoutTypeOutil',[TypeDeOutilDeMesureController::class,"store"])->name("AjoutTypeOutil.Ajouter");
Route::delete('/ListeTypeOutil/{DesTypeOutil:type_outil}',[TypeDeOutilDeMesureController::class,"delete"])->name("TypeOutilMesure.Supprimer");
Route::get('/ModifierUnTypeOutilDeMesure/{DesTypeOutil:type_outil}',[TypeDeOutilDeMesureController::class,"ModifierUnTypeOutilDeMesure"])->name("TypeOutilDeMesure.modifier");
Route::put('/ModifierUnTypeOutilDeMesure/{DesTypeOutil:type_outil}',[TypeDeOutilDeMesureController::class,"update"])->name("TypeOutilDeMesure.update");

// les routes de outil de mesure
Route::get('/ListeDesOutilsDeMesure',[OutilDeMesureController::class,"ListeDesOutils"])->name('ListeDesOutils.affiche');
Route::get('/AjoutUnOutilDeMesure',[OutilDeMesureController::class,"AjoutUnOutilDeMesure"])->name("AjoutUnOutilDeMesure.affiche");
Route::post('/AjoutUnOutilDeMesure',[OutilDeMesureController::class,"store"])->name("AjoutUnOutilDeMesure.Ajouter");
Route::delete('/ListeDesOutilsDeMesure/{DesOutilMesure:outil}',[OutilDeMesureController::class,"delete"])->name("SupprimerOutilMesure");
Route::get('/ModifierUnOutilDeMesure/{DesOutilMesure:outil}',[OutilDeMesureController::class,"ModifierUnOutilDeMesure"])->name("OutilDeMesure.modifier");
Route::put('/ModifierUnOutilDeMesure/{DesOutilMesure:outil}',[OutilDeMesureController::class,"update"])->name("OutilDeMesure.update");

// les routes de bon de sortie
Route::get('/ListeDesBonsDeSortie',[BonDeSortieController::class,"ListeDesBonsDeSortie"])->name('ListeDesBonsDeSortie.affiche');
Route::get('/AjoutUnBonDeSortie',[BonDeSortieController::class,"AjoutUnBonDeSortie"])->name('AjoutBonDeSortie.affiche');
Route::get('/AjoutUnBonDeSortieFind',[BonDeSortieController::class,"FindInformationBS"])->name('BS.findinformation');
Route::get('/AjoutUnBonDeSortieFindoutil',[BonDeSortieController::class,"FindOutilBS"])->name('BS.findOutil');
Route::post('/AjoutUnBonDeSortieCree',[BonDeSortieController::class,"Store"])->name('AjoutUnBonDeSortie.Ajouter');
Route::put('/UnBonDeSortieUpdate/{id:bonSortie}',[BonDeSortieController::class,"update"])->name('AjoutUnBonDeSortie.Update');
Route::get('/BonDeSortieModifier/{id:bonSortie}',[BonDeSortieController::class,"Modifier"])->name('AjoutUnBonDeSortie.Modifier');
Route::delete('/BonDeSortieSupprimer/{id:bonSortie}',[BonDeSortieController::class,"destroy"])->name('AjoutUnBonDeSortie.Supprimer');
Route::get('/BonDeSortieVPDF/{id:bonSortie}',[BonDeSortieController::class,"voirPDF"])->name('AjoutUnBonDeSortie.VoirPDF');
Route::get('/BonDeSortieTPDF/{id:bonSortie}',[BonDeSortieController::class,"TelechargePDF"])->name('AjoutUnBonDeSortie.TelechargePDF');

// les routes de bon de retour
Route::get('/ListeDesBonsDeRetour',[BonDeRetourController::class,"ListeDesBonsDeRetour"])->name('ListeDesBonsDeRetour.affiche');
Route::get('/AjoutUnBonDeRetour',[BonDeRetourController::class,"AjoutUnBonDeRetour"])->name('AjoutBonDeRetour.affiche');
Route::get('/AjoutUnBonDeRetourFind',[BonDeRetourController::class,"FindInformationBR"])->name('BR.findinformation');
Route::post('/AjoutUnBonDeRetourCree',[BonDeRetourController::class,"Store"])->name('AjoutUnBonDeRetour.Ajouter');
Route::put('/UnBonDeRetourUpdate/{id:bonRetour}',[BonDeRetourController::class,"update"])->name('AjoutUnBonDeRetour.Update');
Route::get('/BonDeRetourModifier/{id:bonRetour}',[BonDeRetourController::class,"Modifier"])->name('AjoutUnBonDeRetour.Modifier');
Route::delete('/BonDeRetourSupprimer/{id:bonRetour}',[BonDeRetourController::class,"destroy"])->name('AjoutUnBonDeRetour.Supprimer');
Route::get('/BonDeRetourVPDF/{id:bonRetour}',[BonDeRetourController::class,"voirPDF"])->name('AjoutUnBonDeRetour.VoirPDF');
Route::get('/BonDeRetourTPDF/{id:bonRetour}',[BonDeRetourController::class,"TelechargePDF"])->name('AjoutUnBonDeRetour.TelechargePDF');

// les routes de l'ordre de travail de test de validation
Route::get('/ListeDesOrdresDeTestDeValidation',[OrdreDeTestDeValidationController::class,"ListeDesOrdresDeTestDeValidation"])->name("ListeDesOrdresDeTestDeValidation");
Route::get('/CreerUnOrdreDeTestDeValidation',[OrdreDeTestDeValidationController::class,"CreerUnOrdreDeTestDeValidation"])->name("CreerUnOrdreDeTestDeValidation");
Route::get('/AfficheFicheDeTestDeValidation/{IDOTTV:ordre}', [OrdreDeTestDeValidationController::class,"afficherPDF"])->name('FicheDeTestDeValidation.Affiche');
Route::get('/EnregistreFicheDeTestDeValidation/{IDOTTV:ordre}',[ OrdreDeTestDeValidationController::class,"enregistrerPDF"])->name('FicheDeTestDeValidation.Enregistre');
Route::get('/ModifierUnOrdreDeTravailDeTestDeValidation/{IDOTTV:ordre}', [OrdreDeTestDeValidationController::class,"ModifierUnOrdreDeTravailDeTestDeValidation"])->name("UnOrdreDeTravailDeTestDeValidation.modifier");
Route::delete('/ListeDesOrdresDeTestDeValidation/{IDOTTV:ordre}',[OrdreDeTestDeValidationController::class,"destroy"])->name("OrdreDeTestDeValidation.Supprimer");
Route::post('/CreerUnOrdreDeTestDeValidation',[OrdreDeTestDeValidationController::class,"store"])->name("CreerUnOrdreDeTestDeValidation.creer");
Route::get('/FindParametreOTV',[OrdreDeTestDeValidationController::class,"findParametreOTV"])->name("Cree.findParametreOTV");
Route::get('/FindtypeMesureOTV',[OrdreDeTestDeValidationController::class,"findTypeMesureOTV"])->name("Cree.findTypeMesureOTV");
Route::get('/FindMachineOTV',[OrdreDeTestDeValidationController::class,"findMachineOTV"])->name("Cree.findMachineOTV");
Route::get('/FindDesprecisionOTV',[OrdreDeTestDeValidationController::class,"findDesPrecisionOTV"])->name("Cree.findDesPrecisionOTV");
Route::get('/FindNormalite',[OrdreDeTestDeValidationController::class,"findNormalite"])->name("cree.Normalite");
Route::get('/FindCapabilite',[OrdreDeTestDeValidationController::class,"findCapabilite"])->name("cree.Capabilite");
Route::put('/ModifierUnOrdreDeTravailDeTestDeValidation/{IDOTTV:ordre}',[OrdreDeTestDeValidationController::class,"update"])->name("UnOrdreDeTravailDeTestDeValidation.update");

//les routes de Bon de validation
Route::get('/ListeDesBonsDeValidation',[BonDeValidationController::class,"ListeDesBonsDeValidation"])->name('ListeDesBonsDeValidation.affiche');
Route::get('/AjoutUnBonDeValidation',[BonDeValidationController::class,"AjoutUnBonDeValidation"])->name("AjoutUnBonDeValidation.affiche");
Route::post('/AjoutUnBonDeValidation',[BonDeValidationController::class,"store"])->name("AjoutUnBonDeValidation.Ajouter");
Route::delete('/ListeDesBonsDeValidation/{IDBV:BonDeValidation}',[BonDeValidationController::class,"destroy"])->name("BonDeValidationController.Supprimer");
Route::get('/AfficheBonDeValidation/{IDBV:BonDeValidation}',[BonDeValidationController::class,"afficherPDF"])->name('BonDeValidation.Affiche');
Route::get('/EnregistreBonDeValidation/{IDBV:BonDeValidation}',[BonDeValidationController::class,"enregistrerPDF"])->name('BonDeValidation.Enregistre');
Route::get('/FindInformation',[BonDeValidationController::class,"findinformation"])->name("Cree.findinformation");
Route::get('/FindPrecision',[BonDeValidationController::class,"findprecision"])->name("Cree.findprecision");
Route::get('/FindTypeOutil',[BonDeValidationController::class,"findTypeOutil"])->name("Cree.findTypeOutil");
Route::get('/FindNormalité_ordre_travaille',[BonDeValidationController::class,"findNormaliteOT"])->name("cree.NormaliteOT");
Route::get('/FindCapabilité_ordre_travaille',[BonDeValidationController::class,"findCapabiliteOT"])->name("cree.CapabiliteOT");
Route::get('/FindEchantillonnage_ordre_travaille',[BonDeValidationController::class,"findEchantillonnageOT"])->name("cree.EchantillonnageOT");
Route::get('/FindNormaliteMinimale',[BonDeValidationController::class,"findNormaliteMinimale"])->name("cree.FindNormaliteMinimale");
Route::get('/ModifierUnBonDeValidation/{IDBV:BonDeValidation}',[BonDeValidationController::class,"ModifierUnBonDeValidation"])->name("BonValidation.modifier");
Route::put('/ModifierUnBonDeValidation/{IDBV:BonDeValidation}',[BonDeValidationController::class,"update"])->name("BonValidation.update");

// les routes de l'ordre de travail de mesure
Route::get('/ListeDesOrdresDeTravailDeMesure',[OrdreDeTravailDeMesureController::class,"ListeDesOrdresDeTravailDeMesure"])->name("ListeDesOrdresDeTravailDeMesure");
Route::get('/CreerUnOrdreDeTravailDeMesure',[OrdreDeTravailDeMesureController::class,"CreerUnOrdreDeTravailDeMesure"])->name("CreerUnOrdreDeTravailDeMesure.affiche");
Route::post('/CreerUnOrdreDeTravailDeMesure',[OrdreDeTravailDeMesureController::class,"store"])->name("UnOrdreDeTravailDeMesure.Ajouter");
Route::get('/ModifierUnOrdreDuTravailleDeMesure/{IDOrdreTravailMesure:OTM}',[OrdreDeTravailDeMesureController::class,"Modifier"])->name("OrdereDeMesure.modifier");
Route::put('/ModifierUnOrdreDuTravailleDeMesure/{IDOrdreTravailMesure:OTM}',[OrdreDeTravailDeMesureController::class,"update"])->name("OrdereDeMesure.update");
Route::delete('/ListeUnOrdreDuTravailleDeMesure/{IDOrdreTravailMesure:OTM}',[OrdreDeTravailDeMesureController::class,"destroy"])->name("OrdereDeMesure.Supprimer");
Route::get('/VPDFUnOrdreDuTravailleDeMesure/{IDOrdreTravailMesure:OTM}',[OrdreDeTravailDeMesureController::class,"vuPDF"])->name("OrdereDeMesure.VUPDF");
Route::get('/TPDFUnOrdreDuTravailleDeMesure/{IDOrdreTravailMesure:OTM}',[OrdreDeTravailDeMesureController::class,"downloadPDF"])->name("OrdereDeMesure.DownloadPDF");
Route::get('/FindMachine',[OrdreDeTravailDeMesureController::class,"findMachine"])->name("find.Machine");
Route::get('/FindParametre',[OrdreDeTravailDeMesureController::class,"findParametre"])->name("find.Parametre");
Route::get('/FindtypeOutil',[OrdreDeTravailDeMesureController::class,"findTypeOutil"])->name("find.TypeOutil");
Route::get('/FindPrecisions',[OrdreDeTravailDeMesureController::class,"findPrecision"])->name("find.Precision");
Route::get('/FindBonDeValidation',[OrdreDeTravailDeMesureController::class,"findBonValidation"])->name("find.BonValidation");
Route::get('/VerifTaillePeriode',[OrdreDeTravailDeMesureController::class,"verifTaillePeriode"])->name("ordereMesure.TaillePeriode");
Route::get('/AppendLine',[OrdreDeTravailDeMesureController::class,"Append"])->name("find.AppendLine");
Route::get('/Findetalon',[OrdreDeTravailDeMesureController::class,"findEtalon"])->name("find.Etalon");
Route::get('/Findprecisionetalon',[OrdreDeTravailDeMesureController::class,"Findprecisionetalon"])->name("find.precisionetalon");

//les route de fiche de contrôle totale
Route::get('/ListeDesFichesDeControleTotale',[FicheDeControleTotaleController::class,"ListeDeFicheDeControleTotale"])->name('ListeDeFicheDeControleTotale.affiche');
Route::get('/AjoutUneFicheDeControleTotale',[FicheDeControleTotaleController::class,"AjoutUneFicheDeControleTotale"])->name("AjoutUneFicheDeControleTotale.affiche");
Route::post('/AjoutFicheControle',[FicheDeControleTotaleController::class,"store"])->name("FicheControle.Ajouter");
Route::get('/VPDFFC/{IDFC:FC}',[FicheDeControleTotaleController::class,"FCvuPDF"])->name("Fichecontrole.PDF");
Route::delete('/ListeDesFichesDeControleTotale/{IDFC:FC}',[FicheDeControleTotaleController::class,"destroy"])->name("FichesDeControleTotale.Supprimer");
Route::get('/ModifierFicheDeControleTotale/{IDFC:FC}',[FicheDeControleTotaleController::class,"ModifierFicheDeControleTotale"])->name("FichesDeControleTotale.modifier");
Route::put('/updateFicheDeControleTotale/{IDFC:FC}',[FicheDeControleTotaleController::class,"update"])->name("FichesDeControleTotale.update");
Route::get('/tPDFFicheDeControleTotale/{IDFC:FC}',[FicheDeControleTotaleController::class,"TelechargePDF"])->name("FicheDeControleTotale.DownloadPDF");
Route::get('/FindInformationFC',[FicheDeControleTotaleController::class,"FindInformationFC"])->name("FindInformationFicheControle");
Route::get('/FindInformationPPO',[FicheDeControleTotaleController::class,"FindInformationPPO"])->name("FindInformationPPO");
Route::get('/FindInformationPPO_MValide',[FicheDeControleTotaleController::class,"FindInformationPPOV"])->name("FindInformationPPO_MValide");
Route::get('/FindInformationPPO_MNValideQ',[FicheDeControleTotaleController::class,"FindInformationPPONVQ"])->name("FindInformationPPO_MNQ");
Route::get('/Find_Test_CapabiliteV',[FicheDeControleTotaleController::class,"Find_Test_CapabiliteV"])->name("Find_Test_CapabiliteV");
Route::get('/Find_Test_CapabiliteNVQV',[FicheDeControleTotaleController::class,"Find_Test_CapabiliteNVQV"])->name("Find_Test_CapabiliteNVQV");
Route::get('/Find_Test_CapabiliteNVQ',[FicheDeControleTotaleController::class,"Find_Test_CapabiliteNVQ"])->name("Find_Test_CapabiliteNVQ");
Route::get('/Find_Test_NormaliteV',[FicheDeControleTotaleController::class,"Find_Test_NormaliteV"])->name("Find_Test_NormaliteV");
Route::get('/Find_Test_NormaliteNVQV',[FicheDeControleTotaleController::class,"Find_Test_NormaliteNVQV"])->name("Find_Test_NormaliteNVQV");
Route::get('/Find_Test_NormaliteNVQ',[FicheDeControleTotaleController::class,"Find_Test_NormaliteNVQ"])->name("Find_Test_NormaliteNVQ");

//les route du compte rendu
Route::get('/ListeDesComptesRendus',[CompteRenduController::class,"ListeDeCompteRendu"])->name('ListeDeCompteRendu.affiche');
Route::get('/AjoutCompteRendu',[CompteRenduController::class,"AjoutCompteRendu"])->name('AjoutCompteRendu.affiche');
Route::get('/FindFC_OTM',[CompteRenduController::class,"FindFC_OTM"])->name("FindInformationFC_OTM");
Route::get('/plus',[CompteRenduController::class,"plus"])->name("plus");
Route::post('/AjoutCompteRendu',[CompteRenduController::class,"storecr"])->name("CompteRendu.Ajouter");
Route::delete('/ListeDesComptesRendus/{IDCR:CR}',[CompteRenduController::class,"destroy"])->name("CompteRendu.Supprimer");
Route::get('/ModifierCompteRendu/{IDCR:CR}',[CompteRenduController::class,"ModifierCompteRendu"])->name("CompteRendu.modifier");
Route::put('/updateCompteRendu/{IDCR:CR}',[CompteRenduController::class,"update"])->name("CompteRendu.update");
Route::get('/CompteRenduVPDF/{IDCR:CR}',[CompteRenduController::class,"voirPDF"])->name('CompteRendu.VoirPDF');
Route::get('/CompteRenduTPDF/{IDCR:CR}',[CompteRenduController::class,"TelechargePDF"])->name('CompteRendu.TelechargePDF');

//les route du carte de contrôle
Route::get('/AfficheCarteControle',[CarteControleController::class,"AfficheCarteControle"])->name('CarteControle.affiche');
Route::get('/findparametremesure',[CarteControleController::class,"findparametremesure"])->name('findparametremesure');
Route::get('/findnbrmesure',[CarteControleController::class,"findnbrmesure"])->name('findnbrmesure');
Route::get('/findtol',[CarteControleController::class,"findtol"])->name('findtol');
Route::post('/storecartecontrole',[CarteControleController::class,"store"])->name("CarteControle.store");

/*****************************************************************************************/

//
Route::get('/ParcMachine/empMachine',[EmplMachineController::class,"EmpMachineList"])->name("EmpMachine.list");
Route::get('/ParcMachine/AjouterempMachine',[EmplMachineController::class,"EmpMachineForm"])->name("EmpMachine.form");
Route::post('/ParcMachine/AjouterempMachine',[EmplMachineController::class,"EmpMachineCreate"])->name("EmpMachine.create");
Route::get('/ParcMachine/empMachine/list',[EmplMachineController::class,"findcrud"]);
Route::delete("/ParcMachine/empMachine/supp/{emplacement}", [EmplMachineController::class, "deleteEmplacement"])->name("EmpMachine.supprimer");
Route::get("/ParcMachine/empMachine/modif{emplacement}", [EmplMachineController::class, "EditEmplacement"])->name("EmpMachine.edit");
Route::post('/ParcMachine/ModifierEmpMachine{emplacement}',[EmplMachineController::class,"UpdateEmplacementMachine"])->name("EmpMachine.update");

//
Route::get('/ParcMachine/LocalisationMachine',[LocalisationMachineController::class,"LocMachineList"])->name("LocMachine.list");
Route::get('/ParcMachine/LocalisationMachine/Ajout',[LocalisationMachineController::class,"localisationMachineForm"])->name("LocMachine.form");
Route::get('/ParcMachine/LocalisationMachine/findemp',[LocalisationMachineController::class,"FindEmplacement"]);
Route::post('/ParcMachine/LocalisationMachine/Ajout',[LocalisationMachineController::class,"CreateLocMachine"])->name("LocMachine.create");
Route::get('/ParcMachine/LocalisationMachine/list',[LocalisationMachineController::class,"Findcrud"]);
Route::get("/ParcMachine/LocalisationMachine/modif{atelier}", [LocalisationMachineController::class, "EditAtelier"])->name("LocMachine.edit");
Route::post("/ParcMachine/LocalisationMachine/modifier{atelier}", [LocalisationMachineController::class, "UpdateAtelier"])->name("LocMachine.update");
Route::delete("/ParcMachine/LocalisationMachine/supprimer{atelier}", [LocalisationMachineController::class, "DeleteAtelier"])->name("LocMachine.supprimer");

//
Route::get('ParcMachine/Machine',[MachineController::class,"machineList"])->name("machine.list");
Route::get('ParcMachine/Machine/ajouter',[MachineController::class,"machineForm"])->name("machine.create");
Route::post('ParcMachine/Machine/ajouter',[MachineController::class,"create"])->name("machine.ajout");
Route::delete("ParcMachine/Machine/{DesMachine:machine}", [MachineController::class, "delete"])->name("machine.supprimer");
Route::get("ParcMachine/Machine/{DesMachine:machine}", [MachineController::class, "edit"])->name("machine.edit");
Route::put("ParcMachine/Machine/{DesMachine:machine}", [MachineController::class, "update"])->name("machine.update");
Route::get('ParcMachine/machinegenerate-pdf{DesMachine:machine}',[MachineController::class,"afficherMachinePDF"])->name("pdf_machine");

//
Route::get('/RH/jourferie',[jourFerieController::class,"JourFerieList"])->name("jourferie.list");
Route::get('/RH/ajouterjourferie',[jourFerieController::class,"JourFerieForm"])->name("jourferie.form");
Route::post('/RH/ajouterjourferie',[jourFerieController::class,"createJourFerie"])->name("jourferie.create");
Route::get('/RH/modifierjourferie{jourferie}',[jourFerieController::class,"editJourFerie"])->name("jourferie.edit");
Route::post('/RH/modifierjourferie{jourferie}',[jourFerieController::class,"updateJourFerie"])->name("jourferie.update");
Route::delete('/RH/jourferie{jourferie}',[jourFerieController::class,"deleteJourFerie"])->name("jourferie.supprimer");

//
Route::get('/RH/employe',[employeController::class,"Employelist"])->name("emp.list");
Route::get('/RH/Ajoutemploye',[employeController::class,"Employeform"])->name("emp.form");
Route::post('/RH/Ajoutemploye', [employeController::class, 'create'])->name('create.employe');
Route::post('/RH/Ajoutnote', [employeController::class, 'createNote'])->name('create.note');
Route::delete("/RH/employe/{employe}", [employeController::class, "delete"])->name("employe.supprimer");
Route::put("/RH/employe/{employe}", [employeController::class, "update"])->name("employe.update");
Route::get("/RH/employe/{employe}", [employeController::class, "edit"])->name("employe.edit");
Route::get('/RH/employegenerate-pdf{employe}',[employeController::class,"afficherPDF"])->name("pdf_emp");

//
Route::get('/RH/serviceList',[serviceController::class,"servicelist"])->name("service.list");
Route::get('/RH/ajouterservice',[serviceController::class,"serviceform"])->name("service.form");
Route::post('/RH/ajouterservice',[serviceController::class,"createservice"])->name("service.create");
Route::get('/RH/modifierservice{service}',[serviceController::class,"edit"])->name("service.edit");
Route::post('/RH/modifierservice{service}',[serviceController::class,"updateservice"])->name("bureau.update");
Route::delete('/RH/supprimerBureau{bureaus}',[serviceController::class,"deletebureauservice"])->name("burservice.supprimer");
Route::delete('/RH/supprimerservice{service}',[serviceController::class,"deleteservice"])->name("service.supprimer");
Route::get('/RH/addbureau{service}',[serviceController::class,"BureauForm"])->name("bureau.add");
Route::post('/RH/addbureau{service}',[serviceController::class,"createbureau"])->name("bureau.create");

//
Route::get('/RH/pointage a effectuer',[pointageController::class,"PointageAefflist"])->name("pointaeff.list");
Route::get('/RH/pointageeffectué',[pointageController::class,"Pointageefflist"])->name("pointeff.list");
Route::get('/RH/Ajouterpointageeffectué',[pointageController::class,"Pointageeffform"])->name("pointeff.form");

//
Route::get('/RH/heureSupplementaireAeffectuer',[heuresuppController::class,"Heuresuppaefflist"])->name("heureaeff.list");
Route::get('/RH/AjouterHeureAeffectuer',[heuresuppController::class,"Heuresuppaeffform"])->name("heureaeff.form");
Route::post('/RH/AjouterHeureAeffectuer',[heuresuppController::class,"createheuresuppaeff"])->name("heureaeff.create");
Route::get('/RH/AjouterHeureAeffectuer/{heureaeff}',[heuresuppController::class,"edit"])->name("heureaeff.edit");
Route::post('/RH/AjouterHeureAeffectuer/{heureaeff}',[heuresuppController::class,"updateheureaeff"])->name("heureaeff.update");
Route::delete('/RH/AjouterHeureAeffectuer/{heureaeff}',[heuresuppController::class,"deleteheureaeff"])->name("heureaeff.supprimer");
Route::get('/RH/AjouterHeureAeffectuer/val/{heureaeff}',[heuresuppController::class,"editvalidation"])->name("validation.edit");
Route::post('/RH/heureSupplementaireAeffectuer/val',[heuresuppController::class,"updatevalidation"])->name("validation.update");

//
Route::get('/RH/heureSupplementaireeffectués',[heuresuppController::class,"Heuresuppefflist"])->name("heureeff.list");
Route::get('/RH/AjouterHeureEffectué',[heuresuppController::class,"HeureSuppEffForm"])->name("heureeff.form");
Route::get('/RH/AjouterHeureEffectué/dt',[heuresuppController::class,"finddateheure"]);
Route::get('/RH/AjouterHeureEffectué/prix',[heuresuppController::class,"findprixfordatex"]);
Route::post('/RH/AjouterHeureeffectue',[heuresuppController::class,"createheuresuppeff"])->name("heureeff.create");
//Route::delete('/RH/AjouterHeureeffectue/{heureeff}',[heuresuppController::class,"deleteheureeff"])->name("heureeff.supprimer");

//
Route::get('/RH/InterExtraService',[InterServiceController::class,"Interservicelist"])->name("Interservice.list");
Route::get('RH/InterExtraService/Ajout' ,[InterServiceController::class,"Interserviceform"])->name("Interservice.form");
Route::post('RH/InterExtraService/Ajout',[InterServiceController::class,"createInterservice"])->name("Interservice.create");
Route::get('RH/InterExtraService/Edit{interservice}' ,[InterServiceController::class,"Interserviceedit"])->name("Interservice.edit");
Route::post('RH/InterExtraService/Edit{interservice}' ,[InterServiceController::class,"updateinterservice"])->name("Interservice.update");
Route::delete('RH/InterExtraService/supprimermission{missions}{inter_Service}',[InterServiceController::class,"deletemission"])->name("mission.supprimer");
Route::delete('RH/InterExtraService/supprimerserv{interserv}',[InterServiceController::class,"deleteinterservice"])->name("interservice.supprimer");
Route::get('RH/InterExtraService/AjouterMission{interservice}' ,[InterServiceController::class,"AddMissionform"])->name("mission.form");
Route::post('RH/InterExtraService/AjouterMission{interservice}' ,[InterServiceController::class,"MissionCreate"])->name("mission.create");

//
Route::get('/RH/IntraExtraService',[IntraServiceController::class,"Intraservicelist"])->name("Intraservice.list");
Route::get('/RH/IntraExtraService/Ajout' ,[IntraServiceController::class,"Intraserviceform"])->name("Intraservice.form");
Route::post('/RH/IntraExtraService/Ajouté', [IntraServiceController::class, 'create'])->name('create.intraservice');
Route::delete('/RH/IntraExtraService/{intraservice}',[IntraServiceController::class,"delete"])->name("intraservice.supprimer");
Route::get('/RH/IntraExtraService/operateur',[IntraServiceController::class,"findoperateur"]);
Route::get("/RH/IntraExtraService/{intraservice}", [IntraServiceController::class, "edit"])->name("intraservice.edit");
Route::put("/RH/IntraExtraService/{intraservice}", [IntraServiceController::class, "update"])->name("intraservice.update");

//
Route::get('/RH/conge/planifie',[CongeController::class,"CongePlanifie"])->name("congeplanifie.list");
Route::get('/RH/conge/planifie/ajouter',[CongeController::class,"CongePlanifieform"])->name("congeplanifie.form");
Route::post('/RH/conge/planifie/creer',[CongeController::class,"createcongeplanifie","dateDifference"])->name("congeplanifie.create");
Route::get('/RH/conge/planifie/list',[CongeController::class,"findcrud"]);
Route::delete('/RH/conge/planifie/list/{conge}',[CongeController::class,"deleteconge"])->name("congep.supprimer");

//
Route::get('/RH/conge/Nonplanifie',[CongeController::class,"CongeNonPlanifie"])->name("congenonplanifie.list");
Route::get('/RH/conge/Nonplanifie/ajouter',[CongeController::class,"CongeNonPlanifieform"])->name("congenonplanifie.form");
Route::post('/RH/conge/Nonplanifie/creer',[CongeController::class,"createcongeNonplanifie","dateDifference"])->name("congenonplanifie.create");
Route::get('/RH/conge/Nonplanifie/list',[CongeController::class,"findcrudNonPlanifie"]);
Route::delete('/RH/conge/Nonplanifie/list/{conge}',[CongeController::class,"deletecongeNonPlanifié"])->name("congenonp.supprimer");

//
Route::get('/RH/pointage a effectuer',[PointageAEffectuerController::class,"pointageAEffList"])->name("pointaeff.list");
Route::get('/RH/Ajouter un pointage à effectuer',[PointageAEffectuerController::class,"pointageAEffForm"])->name("pointaeff.create");
Route::post('/RH/pointage ajoute',[PointageAEffectuerController::class,"create"])->name("pointaeff.add");
Route::get('/RH/crudpointageaeff/des',[PointageAEffectuerController::class,"finddes"]);
Route::get('/RH/crudpointageaeff/datedeb',[PointageAEffectuerController::class,"finddtdeb"]);
Route::get('/RH/crudpointageaeff/datefin',[PointageAEffectuerController::class,"finddtfin"]);
Route::get('/RH/crudpointageaeff/lignes',[PointageAEffectuerController::class,"findligne"]);
Route::get('/RH/crudpointageaeff/jourpause',[PointageAEffectuerController::class,"findjours"]);
Route::get('/RH/crudpointageaeff/pausedepointage',[PointageAEffectuerController::class,"findpauses"]);
Route::delete("/RH/crudpointageaeff/jour/{jour}", [PointageAEffectuerController::class, "delete"])->name("jour.supprimer");

//
Route::post('/RH/pause/createpause',[PauseController::class,"create"])->name(("pause.create"));
Route::get('/RH/pause',[PauseController::class,"index"])->name("pause.form");
Route::get('/RH/pause/dtdeb',[PauseController::class,"finddatedeb"]);
Route::get('/RH/pause/dtfin',[PauseController::class,"finddatefin"]);
Route::get('/RH/pause/despoint',[PauseController::class,"finddes"]);
Route::get('/RH/pause/joursdes',[PauseController::class,"findjours"]);
Route::delete("/RH/pausedelete/{pause}", [PauseController::class, "delete"])->name("pause.supprimer");

//
Route::get('/RH/pointageeffectué',[PointageEffectueController::class,"Pointageefflist"])->name("pointeff.list");
Route::get('/RH/Ajouterpointageeffectué',[PointageEffectueController::class,"Pointageeffform"])->name("pointeff.form");
Route::post('/RH/pointageeffectuéaajouté',[PointageEffectueController::class,"create"])->name("pointeff.create");
Route::delete("/RH/pointageeffectué/{pointageeff}", [PointageEffectueController::class, "delete"])->name("pointageeff.supprimer");
Route::put("/RH/pointageeffectué/{pointageeff}", [PointageEffectueController::class, "update"])->name("pointageeff.update");
Route::get("/RH/pointageeffectué/{pointageeff}", [PointageEffectueController::class, "edit"])->name("pointageeff.edit");

//
Route::get('/RH/PonctualitePersonnelle',[PonctualitePersonnelleController::class,"PonctualitePersonnelleForm"])->name("PonctualitePersonnelle.form");
Route::get('/RH/PonctualitePersonnelle/findEmploye',[PonctualitePersonnelleController::class,"FindEmploye"]);
Route::get('/RH/PonctualitePersonnelle/crudNotePonctualitePersonnelleMensuelle',[PonctualitePersonnelleController::class,"PonctualitePersonnelleMensuelleCrud"])->name("PonctualitePersonnelleMens.crud");
Route::get('/RH/PonctualitePersonnelle/chartNotePonctualitePersonnelleMensuelle',[PonctualitePersonnelleController::class,"ponctualitePersChart"])->name("PonctualitePersonnelleMens.chart");
Route::post('/RH/PonctualitePersonnelleMens/Calculer',[PonctualitePersonnelleMensuelleController::class,"CalculerPonctuaMensuelle"])->name('Ponctualite.calculer');
Route::post('/RH/PonctualitePersonnelleAn/Calculer',[PonctualitePersonnelleAnnuelleController::class,"CalculerPonctuaAnnuelle"])->name('PonctualitePerAnn.calculer');
Route::post('/RH/PonctualitePersonnelleJournalier/Calculer',[PonctualitePersonnelleJournaliereController::class,"CalculerPonctuaJournalier"])->name('PonctualitePerJournalier.calculer');

//
Route::get('/RH/PonctualitePersonnelle/crudNotePonctualitePersonnelleAnnuelle',[PonctualitePersonnelleController::class,"PonctualitePersonnelleAnnuelleCrud"])->name("PonctualitePersonnelleAnn.crud");
Route::post('/RH/PonctualitePersonnelleTotal/Calculer',[PonctualitePersonnelleTotalController::class,"calculPonctualiteTotal"])->name('PonctualitePerTotal.calculer');
Route::get('/RH/PonctualitePersonnelle/crudNotePonctualitePersonnelleTotal',[PonctualitePersonnelleController::class,"PonctualitePersonnelleTotalCrud"])->name("PonctualitePersonnelleTotal.crud");
Route::get('/RH/PonctualitePersonnelle/crudNotePonctualitePersonnelleJournaliere',[PonctualitePersonnelleController::class,"PonctualitePersonnelleJournaliereCrud"])->name("PonctualitePersonnelleJournaliere.crud");
Route::get('/RH/PonctualitePersonnelleJournaliereChart/Evaluer',[PonctualitePersonnelleJournaliereController::class,"afficheEvaluerJour"])->name("PonctualitePersonnelleJournaliere.chart");

//
Route::get('/RH/PonctualitePersonnelle/Evaluer',[PonctualitePersonnelleController::class,"PonctualitePersonnelleMensuelleChart"])->name("PonctualitePersonnelleMensuelle.chart");
Route::get('/RH/Ponctualite/PersonnellePartielle',[PonctualitePersonnelleController::class,"findAnne"]);
Route::get('/RH/Ponctualite/PersonnellePartielleJourFindAnnee',[PonctualitePersonnelleController::class,"findAnneJourn"]);

//
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchart',[PonctualitePersonnelleController::class,"findChart"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourVend',[PonctualitePersonnelleController::class,"findChartJourVend"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourLundi',[PonctualitePersonnelleController::class,"findChartJourLundi"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourMardi',[PonctualitePersonnelleController::class,"findChartJourMardi"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourMercredi',[PonctualitePersonnelleController::class,"findChartJourMercredi"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourJeudi',[PonctualitePersonnelleController::class,"findChartJourJeudi"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourSamedi',[PonctualitePersonnelleController::class,"findChartJourSamedi"]);
Route::get('/RH/NotePenctualite/PersonnellePartielle/findchartJourDimanche',[PonctualitePersonnelleController::class,"findChartJourDimanche"]);

//
Route::get('/RH/Probabilite',[ProbabiliteController::class,"ProbabiliteForm"])->name("Probabilite.form");
Route::post('/RH/ProbabiliteMensuelle/Calculer',[ProbabiliteController::class,"CalculerProbMensuelle"])->name('ProbMensuelle.calculer');
Route::get('/RH/ProbabiliteMensuelle/Afficher',[ProbabiliteController::class,"ProbPresenceCongeMensuelleAffiche"])->name('ProbMensuelle.Afficher');
Route::post('/RH/ProbabiliteAnnuelle/Calculer',[ProbabiliteController::class,"CalculerProbAnnuelle"])->name('ProbAnnuelle.calculer');
Route::get('/RH/ProbabiliteAnnuelle/Afficher',[ProbabiliteController::class,"ProbPresenceCongeAnnuelleAffiche"])->name('ProbAnnuelle.Afficher');
Route::post('/RH/ProbabiliteTotal/Calculer',[ProbabiliteController::class,"CalculerProbTotal"])->name('ProbTotal.calculer');
Route::get('/RH/ProbabiliteTotal/Afficher',[ProbabiliteController::class,"ProbPresenceCongeTotalAffiche"])->name('ProbTotal.Afficher');

//
Route::get('/RH/NoteAssiduite',[NoteAssiduiteController::class,"NoteAssiduiteForm"])->name("NoteAssiduite.form");
Route::post('/RH/NoteAssiduite/notePresenceCalculer',[NoteAssiduiteController::class,"calculPresenceMensuelle"])->name("NotePresenceMensuelle.calculer");
Route::get('/RH/NoteAssiduite/notePresenceEvaluer',[NoteAssiduiteController::class,"NotePresenceMensuelle"])->name("NotePresenceMensuelle.evaluer");
Route::get('/RH/NoteAssiduite/notePresenceEvaluer/findAnneeDebut',[NoteAssiduiteController::class,"FindAnneeDebut"]);
Route::get('/RH/NoteAssiduite/notePresenceEvaluer/findchart',[NoteAssiduiteController::class,"FindChart"]);
Route::get('/RH/NoteAssiduite/notePresenceAfficher',[NoteAssiduiteController::class,"NotePresenceMensuelleAffiche"])->name('NotePresenceMensuelle.Afficher');
Route::post('/RH/NoteAssiduite/notePresenceAnnCalculer',[NoteAssiduiteController::class,"calculPresenceAnnuelle"])->name("NotePresenceAnnuelle.calculer");
Route::post('/RH/NoteAssiduite/noteProbabiliteJournaliereCalculer',[NoteProbabiliteJournaliereController::class,"calculerNoteProbJournaliere"])->name("NoteProbaJournaliere.calculer");

//
Route::get('/RH/TableauBord',[TableauBordPieController::class,"TableauBordAffiche"])->name("TableauBord.Affiche");
Route::get('/RH/TableauBord/annee',[TableauBordPieController::class,"FindAnnee"]);
Route::get('/RH/TableauBord/anneePonctMens',[TableauBordPieController::class,"FindAnneeponctmens"]);
Route::get('/RH/TableauBord/anneeProbaJourna',[TableauBordPieController::class,"FindAnneeProbaJourna"]);
Route::get('/RH/TableauBord/chartPresence',[TableauBordPieController::class,"FindChart"]);
Route::get('/RH/TableauBord/chartPonctMensPers',[TableauBordPieController::class,"FindChartPersMens"]);
Route::get('/RH/TableauBord/chartProbabiliteJournaliere',[TableauBordPieController::class,"FindChartProbaJournaliere"]);

//
Route::get('/RH/TableauBordAideDecision',[TableauBordAideDecisionController::class,"chartview"])->name("TableauBordDecision.Afficher");
Route::get('RH/TableauBordAideDecision/findChart1',[TableauBordAideDecisionController::class,"findChart1"]);
Route::get('RH/TableauBordAideDecision/findChart2',[TableauBordAideDecisionController::class,"findChart2"]);
Route::get('RH/TableauBordAideDecision/findChart3',[TableauBordAideDecisionController::class,"findChart3"]);

//
Route::get('Production/config/outilfabrication',[OutilFabricationController::class,"outilListe"])->name("outil.list");
Route::get('Production/config/outilfabrication/ajout',[OutilFabricationController::class,"outilForm"])->name("outil.create");
Route::post('Production/config/outilfabrication/ajoute',[OutilFabricationController::class,"create"])->name("outil.ajout");
Route::delete("Production/config/outilfabrication/{outil}", [OutilFabricationController::class, "delete"])->name("outil.supprimer");

//
Route::get('/Production/Produitlist',[ProduitController::class,"ProduitList"])->name("Produit.list");
Route::get('/Production/Produit/AjouterProduitConstruisable',[ProduitController::class,"ProduitConstruisableForm"])->name("ProduitConstruisable.form");
Route::post('/Production/Produit/AjouterProduitConstruisable',[ProduitController::class,"ProduitConstruisableCreate"])->name("ProduitConstruisable.create");
Route::delete('/Production/Produit/supprimer{DesProduitC:prodconst}',[ProduitController::class,"deleteProduitConstruisable"])->name("ProduitConstruisable.supprimer");
Route::get('/Production/Produit/produitgenerate-pdf/{DesProduitC:prodconst}',[ProduitController::class,"afficherProduitPDF"])->name("pdf_produit");


//
Route::get('/Production/Produit/AjouterProduitAchetable',[ProduitController::class,"ProduitAchetableForm"])->name("ProduitAchetable.form");
Route::post('/Production/Produit/AjouterProduitAchetable',[ProduitController::class,"ProduitAchetableCreate"])->name("ProduitAchetable.create");
Route::delete('/Production/ProduitAchetable/supprimer/{DesProduitA:produit_achet}',[ProduitController::class,"deleteProduitAchetable"])->name("ProduitAchetable.supprimer");
Route::get('/Production/Produit/AjouterProduitAchetable/prod2',[ProduitController::class,"FindProduit2"]);

//
Route::get('/Production/TempsReglageForm',[ProduitController::class,"tempsReglageForm"])->name("tempsReglage.form");
Route::get('/Production/TempsReglageList',[ProduitController::class,"tempsReglageList"])->name("tempsReglage.list");
Route::post('/Production/TempsReglage/ajouter',[ProduitController::class,"TempsReglagesCreate"])->name("tempsReglage.create");
Route::delete("Production/TempsReglage/supprimer{tempsreglage}", [ProduitController::class, "deleteTempsReglage"])->name("tempsreglage.supprimer");
Route::get("Production/TempsReglage/edit{tempsreglage}", [ProduitController::class, "editTempsReglage"])->name("tempsreglage.edit");
Route::put("Production/TempsReglage/update{tempsreglage}", [ProduitController::class, "updateTempsReglage"])->name("tempsreglage.update");

//
Route::get('/Production/Nomenclature',[NomenclatureController::class,"NomenclatureList"])->name("Nomenclature.list");
Route::get('/Production/Nomenclature/Ajouter',[NomenclatureController::class,"NomenclatureForm"])->name("Nomenclature.form");
Route::get('/Production/Nomenclature/Modifier{nomenclature}',[NomenclatureController::class,"NomenclatureEdit"])->name("Nomenclature.edit");
Route::post('/Production/Nomenclature/Modifier{nomenclature}',[NomenclatureController::class,"UpdateNomenclature"])->name("Nomenclature.update");
Route::get('/Production/Nomenclature/FindComposant',[NomenclatureController::class,"FindProduit"]);
Route::post('/Production/Nomenclature/Ajouter',[NomenclatureController::class,"NomenclatureCreate"])->name("Nomenclature.create");
Route::delete('/Production/Nomenclature/supprimerconst{const}',[NomenclatureController::class,"DeleteConstituerPar"])->name("ConstituerPar.supprimer");
Route::delete('/Production/Nomenclature/supprimerNomen{nomenclature}',[NomenclatureController::class,"DeleteNomenclature"])->name("Nomenclature.supprimer");
Route::get('/Production/AjouterComposant{nomenclature}',[NomenclatureController::class,"AddComposantNomenclatureForm"])->name("AddComposantNomenclature.form");
Route::post('/Production/AjouterComposant{nomenclature}',[NomenclatureController::class,"CreateComposantNomenclature"])->name("ComposantNomenclature.create");

//
Route::get('Production/config/consommation/ajout',[ConsommationController::class,"consForm"])->name("Cons.create");
Route::post('Production/config/consommation/ajoute',[ConsommationController::class,"create"])->name("Cons.ajout");
Route::get('Production/config/consommation/List',[ConsommationController::class,"consList"])->name("Cons.List");
Route::delete("Production/config/consommation/{consommer}", [ConsommationController::class, "delete"])->name("cons.supprimer");

//
Route::get('MRP2/affichage_prevision',[PrevisionVenteController::class,"affichagePrevision"])->name("Previson_Vente.list");
Route::get('MRP2/affichage_prevision/prevision_vente',[PrevisionVenteController::class,"tableauPrevision"])->name("Previson_Vente.create");
Route::get('MRP2/affichage_capacite_machine',[CapaciteMachineController::class,"tableauCapaciteMachine"])->name("Capacite_machine.aff");
Route::get('MRP2/calcul_besoin',[PrevisionVenteController::class,"calculBesoin"])->name("calculBesoin.aff");
Route::get('MRP2/gamme_de_fabrication',[GammeController::class,"gammeAffiche"])->name("gamme.aff");
Route::get('MRP2/calcul_charges_produit',[CalculChargesController::class,"calculChargeProduit"])->name("calculChargesProd.aff");
Route::get('MRP2/calcul_charges_machine',[CalculChargesController::class,"calculChargeMachine"])->name("calculChargesMachine.aff");









