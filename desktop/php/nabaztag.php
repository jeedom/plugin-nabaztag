<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}

global $listCmdNabaztag;

include_file('core', 'nabaztag', 'config', 'nabaztag');
sendVarToJS('eqType', 'nabaztag');
?>

<div class="row row-overflow">
    <div class="col-lg-2">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un équipement}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
                foreach (eqLogic::byType('nabaztag') as $eqLogic) {
                    echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName() . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-10 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
        <form class="form-horizontal">
            <fieldset>
                <legend>{{Général}}</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Nom de l'équipement Nabaztag}}</label>
                    <div class="col-lg-3">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                        <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement Nabaztag}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" >{{Objet parent}}</label>
                    <div class="col-lg-3">
                        <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                            <option value="">{{Aucun}}</option>
                            <?php
                            foreach (object::all() as $object) {
                                echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">{{Catégorie}}</label>
                    <div class="col-lg-8">
                        <?php
                        foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
                            echo '<label class="checkbox-inline">';
                            echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
                            echo '</label>';
                        }
                        ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" >{{Activer}}</label>
                    <div class="col-lg-1">
                        <input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>
                    </div>
                    <label class="col-lg-2 control-label" >{{Visible}}</label>
                    <div class="col-lg-1">
                        <input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Adresse (openjabnab.fr ou @IP)}}</label>
                    <div class="col-lg-3">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="addr" placeholder="{{openjabnab.fr ou @IP}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Adresse MAC}}</label>
                    <div class="col-lg-3">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="mac" placeholder="{{Adresse MAC}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Token}}</label>
                    <div class="col-lg-3">
                        <input type="password" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="token" placeholder="{{Token}}"/>
                    </div>
                </div>
            </fieldset> 
        </form>

        <legend>Commandes</legend>
        <a class="btn btn-success btn-sm cmdAction" data-action="add"><i class="fa fa-plus-circle"></i>{{ Ajouter une commande Nabaztag}}</a><br/><br/>
        <div class="alert alert-info">
            {{Sous type : <br/>
            - Slider : mettre #slider# pour recupérer la valeur<br/>
            - Message : mettre #title# et #message#}}
        </div>
        <table id="table_cmd" class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th style="width: 200px;">{{Nom}}</th>
                    <th style="width: 100px;">{{Type}}</th>
                    <th>{{Parametre(s)}}</th>
                    <th style="width: 100px;"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <form class="form-horizontal">
            <fieldset>
                <div class="form-actions">
                    <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
                    <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
                </div>
            </fieldset>
        </form>

    </div>
</div>

<div class="modal fade" id="md_addPreConfigCmdNabaztag">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>{{Ajouter une commande prédefinie}}</h3>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display: none;" id="div_addPreConfigCmdNabaztagError"></div>
                <form class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-4 control-label" for="in_addPreConfigCmdNabaztagName">{{Fonctions}}</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="sel_addPreConfigCmdNabaztag">
                                    <?php
                                    foreach ($listCmdNabaztag as $key => $cmdNabaztag) {
                                        echo "<option value='" . $key . "'>" . $cmdNabaztag['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <div class="alert alert-success">
                    <center><h4>{{Version}} 
                            <?php
                            foreach ($listCmdNabaztag as $key => $cmdNabaztag) {
                                echo '<span class="json_cmd ' . $key . ' hide" style="display : none;" >' . json_encode($cmdNabaztag,JSON_UNESCAPED_UNICODE) . '</span>';
                                echo '<span class="version ' . $key . '" style="display : none;">' . $cmdNabaztag['version'] . '</span>';
                            }
                            ?>
                        </h4></center>
                </div>
                <div class="alert alert-info">
                    <center><h4>{{Description}}</h4></center>
                    <?php
                    foreach ($listCmdNabaztag as $key => $cmdNabaztag) {
                        echo '<span class="description ' . $key . '" style="display : none;">' . $cmdNabaztag['description'] . '</span>';
                    }
                    ?>
                </div>
                <div class="alert alert-danger">
                    <center><h4>{{Pré-requis}}</h4></center>
                    <?php
                    foreach ($listCmdNabaztag as $key => $cmdNabaztag) {
                        echo '<span class="required ' . $key . '" style="display : none;">' . $cmdNabaztag['required'] . '</span>';
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" data-dismiss="modal"><i class="fa fa-minus-circle"></i> {{Annuler}}</a>
                <a class="btn btn-success" id="bt_addPreConfigCmdNabaztagSave"><i class="fa fa-check-circle"></i> {{Ajouter}}</a>
            </div>
        </div>
    </div>
</div>

<?php include_file('desktop', 'nabaztag', 'js', 'nabaztag'); ?>
<?php include_file('core', 'plugin.template', 'js'); ?>
