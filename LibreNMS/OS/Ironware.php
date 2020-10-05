<?php
/**
 * Ironware.php
 *
 * Brocade Ironware OS
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link       http://librenms.org
 * @copyright  2018 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace LibreNMS\OS;

use App\Models\Device;
use LibreNMS\OS\Shared\Foundry;

class Ironware extends Foundry
{
    public function discoverOS(Device $device): void
    {
        parent::discoverOS($device); // yaml

        $this->rewriteHardware();
    }

    private function rewriteHardware()
    {
        $rewrite_ironware_hardware = [
            'snFIWGSwitch' => 'Stackable FastIron workgroup',
            'snFIBBSwitch' => 'Stackable FastIron backbone',
            'snNIRouter' => 'Stackable NetIron',
            'snSI' => 'Stackable ServerIron',
            'snSIXL' => 'Stackable ServerIronXL',
            'snSIXLTCS' => 'Stackable ServerIronXL TCS',
            'snTISwitch' => 'Stackable TurboIron',
            'snTIRouter' => 'Stackable TurboIron',
            'snT8Switch' => 'Stackable TurboIron 8',
            'snT8Router' => 'Stackable TurboIron 8',
            'snT8SIXLG' => 'Stackable ServerIronXLG',
            'snBI4000Switch' => 'BigIron 4000',
            'snBI4000Router' => 'BigIron 4000',
            'snBI4000SI' => 'BigServerIron',
            'snBI8000Switch' => 'BigIron 8000',
            'snBI8000Router' => 'BigIron 8000',
            'snBI8000SI' => 'BigServerIron',
            'snFI2Switch' => 'FastIron II',
            'snFI2Router' => 'FastIron II',
            'snFI2PlusSwitch' => 'FastIron II Plus',
            'snFI2PlusRouter' => 'FastIron II Plus',
            'snNI400Router' => 'NetIron 400',
            'snNI800Router' => 'NetIron 800',
            'snFI2GCSwitch' => 'FastIron II GC',
            'snFI2GCRouter' => 'FastIron II GC',
            'snFI2PlusGCSwitch' => 'FastIron II Plus GC',
            'snFI2PlusGCRouter' => 'FastIron II Plus GC',
            'snBI15000Switch' => 'BigIron 15000',
            'snBI15000Router' => 'BigIron 15000',
            'snNI1500Router' => 'NetIron 1500',
            'snFI3Switch' => 'FastIron III',
            'snFI3Router' => 'FastIron III',
            'snFI3GCSwitch' => 'FastIron III GC',
            'snFI3GCRouter' => 'FastIron III GC',
            'snSI400Switch' => 'ServerIron 400',
            'snSI400Router' => 'ServerIron 400',
            'snSI800Switch' => 'ServerIron800',
            'snSI800Router' => 'ServerIron800',
            'snSI1500Switch' => 'ServerIron1500',
            'snSI1500Router' => 'ServerIron1500',
            'sn4802Switch' => 'Stackable 4802',
            'sn4802Router' => 'Stackable 4802',
            'sn4802SI' => 'Stackable 4802 ServerIron',
            'snFI400Switch' => 'FastIron 400',
            'snFI400Router' => 'FastIron 400',
            'snFI800Switch' => 'FastIron800',
            'snFI800Router' => 'FastIron800',
            'snFI1500Switch' => 'FastIron1500',
            'snFI1500Router' => 'FastIron1500',
            'snFES2402' => 'FES 2402',
            'snFES2402Switch' => 'FES2402',
            'snFES2402Router' => 'FES2402',
            'snFES4802' => 'FES 4802',
            'snFES4802Switch' => 'FES4802',
            'snFES4802Router' => 'FES4802',
            'snFES9604' => 'FES 9604',
            'snFES9604Switch' => 'FES9604',
            'snFES9604Router' => 'FES9604',
            'snFES12GCF' => 'FES 12GCF ',
            'snFES12GCFSwitch' => 'FES12GCF ',
            'snFES12GCFRouter' => 'FES12GCF',
            'snFES2402P' => 'FES 2402 POE ',
            'snFES4802P' => 'FES 4802 POE ',
            'snNI4802Switch' => 'NetIron 4802',
            'snNI4802Router' => 'NetIron 4802',
            'snBIMG8Switch' => 'BigIron MG8',
            'snBIMG8Router' => 'BigIron MG8',
            'snNI40GRouter' => 'NetIron 40G',
            'snFESX424' => 'FES 24G',
            'snFESX424Switch' => 'FESX424',
            'snFESX424Router' => 'FESX424',
            'snFESX424Prem' => 'FES 24G-PREM',
            'snFESX424PremSwitch' => 'FESX424-PREM',
            'snFESX424PremRouter' => 'FESX424-PREM',
            'snFESX424Plus1XG' => 'FES 24G + 1 10G',
            'snFESX424Plus1XGSwitch' => 'FESX424+1XG',
            'snFESX424Plus1XGRouter' => 'FESX424+1XG',
            'snFESX424Plus1XGPrem' => 'FES 24G + 1 10G-PREM',
            'snFESX424Plus1XGPremSwitch' => 'FESX424+1XG-PREM',
            'snFESX424Plus1XGPremRouter' => 'FESX424+1XG-PREM',
            'snFESX424Plus2XG' => 'FES 24G + 2 10G',
            'snFESX424Plus2XGSwitch' => 'FESX424+2XG',
            'snFESX424Plus2XGRouter' => 'FESX424+2XG',
            'snFESX424Plus2XGPrem' => 'FES 24G + 2 10G-PREM',
            'snFESX424Plus2XGPremSwitch' => 'FESX424+2XG-PREM',
            'snFESX424Plus2XGPremRouter' => 'FESX424+2XG-PREM',
            'snFESX448' => 'FES 48G',
            'snFESX448Switch' => 'FESX448',
            'snFESX448Router' => 'FESX448',
            'snFESX448Prem' => 'FES 48G-PREM',
            'snFESX448PremSwitch' => 'FESX448-PREM',
            'snFESX448PremRouter' => 'FESX448-PREM',
            'snFESX448Plus1XG' => 'FES 48G + 1 10G',
            'snFESX448Plus1XGSwitch' => 'FESX448+1XG',
            'snFESX448Plus1XGRouter' => 'FESX448+1XG',
            'snFESX448Plus1XGPrem' => 'FES 48G + 1 10G-PREM',
            'snFESX448Plus1XGPremSwitch' => 'FESX448+1XG-PREM',
            'snFESX448Plus1XGPremRouter' => 'FESX448+1XG-PREM',
            'snFESX448Plus2XG' => 'FES 48G + 2 10G',
            'snFESX448Plus2XGSwitch' => 'FESX448+2XG',
            'snFESX448Plus2XGRouter' => 'FESX448+2XG',
            'snFESX448Plus2XGPrem' => 'FES 48G + 2 10G-PREM',
            'snFESX448Plus2XGPremSwitch' => 'FESX448+2XG-PREM',
            'snFESX448Plus2XGPremRouter' => 'FESX448+2XG-PREM',
            'snFESX424Fiber' => 'FESFiber 24G',
            'snFESX424FiberSwitch' => 'FESX424Fiber',
            'snFESX424FiberRouter' => 'FESX424Fiber',
            'snFESX424FiberPrem' => 'FESFiber 24G-PREM',
            'snFESX424FiberPremSwitch' => 'FESX424Fiber-PREM',
            'snFESX424FiberPremRouter' => 'FESX424Fiber-PREM',
            'snFESX424FiberPlus1XG' => 'FESFiber 24G + 1 10G',
            'snFESX424FiberPlus1XGSwitch' => 'FESX424Fiber+1XG',
            'snFESX424FiberPlus1XGRouter' => 'FESX424Fiber+1XG',
            'snFESX424FiberPlus1XGPrem' => 'FESFiber 24G + 1 10G-PREM',
            'snFESX424FiberPlus1XGPremSwitch' => 'FESX424Fiber+1XG-PREM',
            'snFESX424FiberPlus1XGPremRouter' => 'FESX424Fiber+1XG-PREM',
            'snFESX424FiberPlus2XG' => 'FESFiber 24G + 2 10G',
            'snFESX424FiberPlus2XGSwitch' => 'FESX424Fiber+2XG',
            'snFESX424FiberPlus2XGRouter' => 'FESX424Fiber+2XG',
            'snFESX424FiberPlus2XGPrem' => 'FESFiber 24G + 2 10G-PREM',
            'snFESX424FiberPlus2XGPremSwitch' => 'FESX424Fiber+2XG-PREM',
            'snFESX424FiberPlus2XGPremRouter' => 'FESX424Fiber+2XG-PREM',
            'snFESX448Fiber' => 'FESFiber 48G',
            'snFESX448FiberSwitch' => 'FESX448Fiber',
            'snFESX448FiberRouter' => 'FESX448Fiber',
            'snFESX448FiberPrem' => 'FESFiber 48G-PREM',
            'snFESX448FiberPremSwitch' => 'FESX448Fiber-PREM',
            'snFESX448FiberPremRouter' => 'FESX448Fiber-PREM',
            'snFESX448FiberPlus1XG' => 'FESFiber 48G + 1 10G',
            'snFESX448FiberPlus1XGSwitch' => 'FESX448Fiber+1XG',
            'snFESX448FiberPlus1XGRouter' => 'FESX448Fiber+1XG',
            'snFESX448FiberPlus1XGPrem' => 'FESFiber 48G + 1 10G-PREM',
            'snFESX448FiberPlus1XGPremSwitch' => 'FESX448Fiber+1XG-PREM',
            'snFESX448FiberPlus1XGPremRouter' => 'FESX448Fiber+1XG-PREM',
            'snFESX448FiberPlus2XG' => 'FESFiber 48G + 2 10G',
            'snFESX448FiberPlus2XGSwitch' => 'FESX448Fiber+2XG',
            'snFESX448FiberPlus2XGRouter' => 'FESX448+2XG',
            'snFESX448FiberPlus2XGPrem' => 'FESFiber 48G + 2 10G-PREM',
            'snFESX448FiberPlus2XGPremSwitch' => 'FESX448Fiber+2XG-PREM',
            'snFESX448FiberPlus2XGPremRouter' => 'FESX448Fiber+2XG-PREM',
            'snFESX424P' => 'FES 24G POE',
            'snFESX624' => 'FastIron Edge V6 Switch(FES) 24G',
            'snFESX624Switch' => 'FESX624',
            'snFESX624Router' => 'FESX624',
            'snFESX624Prem' => 'FastIron Edge V6 Switch(FES) 24G-PREM',
            'snFESX624PremSwitch' => 'FESX624-PREM',
            'snFESX624PremRouter' => 'FESX624-PREM',
            'snFESX624Plus1XG' => 'FastIron Edge V6 Switch(FES) 24G + 1 10G',
            'snFESX624Plus1XGSwitch' => 'FESX624+1XG',
            'snFESX624Plus1XGRouter' => 'FESX624+1XG',
            'snFESX624Plus1XGPrem' => 'FastIron Edge V6 Switch(FES) 24G + 1 10G-PREM',
            'snFESX624Plus1XGPremSwitch' => 'FESX624+1XG-PREM',
            'snFESX624Plus1XGPremRouter' => 'FESX624+1XG-PREM',
            'snFESX624Plus2XG' => 'FastIron Edge V6 Switch(FES) 24G + 2 10G',
            'snFESX624Plus2XGSwitch' => 'FESX624+2XG',
            'snFESX624Plus2XGRouter' => 'FESX624+2XG',
            'snFESX624Plus2XGPrem' => 'FastIron Edge V6 Switch(FES) 24G + 2 10G-PREM',
            'snFESX624Plus2XGPremSwitch' => 'FESX624+2XG-PREM',
            'snFESX624Plus2XGPremRouter' => 'FESX624+2XG-PREM',
            'snFESX648' => 'FastIron Edge V6 Switch(FES) 48G',
            'snFESX648Switch' => 'FESX648',
            'snFESX648Router' => 'FESX648',
            'snFESX648Prem' => 'FastIron Edge V6 Switch(FES) 48G-PREM',
            'snFESX648PremSwitch' => 'FESX648-PREM',
            'snFESX648PremRouter' => 'FESX648-PREM',
            'snFESX648Plus1XG' => 'FastIron Edge V6 Switch(FES) 48G + 1 10G',
            'snFESX648Plus1XGSwitch' => 'FESX648+1XG',
            'snFESX648Plus1XGRouter' => 'FESX648+1XG',
            'snFESX648Plus1XGPrem' => 'FastIron Edge V6 Switch(FES) 48G + 1 10G-PREM',
            'snFESX648Plus1XGPremSwitch' => 'FESX648+1XG-PREM',
            'snFESX648Plus1XGPremRouter' => 'FESX648+1XG-PREM',
            'snFESX648Plus2XG' => 'FastIron Edge V6 Switch(FES) 48G + 2 10G',
            'snFESX648Plus2XGSwitch' => 'FESX648+2XG',
            'snFESX648Plus2XGRouter' => 'FESX648+2XG',
            'snFESX648Plus2XGPrem' => 'FastIron Edge V6 Switch(FES) 48G + 2 10G-PREM',
            'snFESX648Plus2XGPremSwitch' => 'FESX648+2XG-PREM',
            'snFESX648Plus2XGPremRouter' => 'FESX648+2XG-PREM',
            'snFESX624Fiber' => 'FastIron V6 Edge Switch(FES)Fiber 24G',
            'snFESX624FiberSwitch' => 'FESX624Fiber',
            'snFESX624FiberRouter' => 'FESX624Fiber',
            'snFESX624FiberPrem' => 'FastIron Edge V6 Switch(FES)Fiber 24G-PREM',
            'snFESX624FiberPremSwitch' => 'FESX624Fiber-PREM',
            'snFESX624FiberPremRouter' => 'FESX624Fiber-PREM',
            'snFESX624FiberPlus1XG' => 'FastIron Edge V6 Switch(FES)Fiber 24G + 1 10G',
            'snFESX624FiberPlus1XGSwitch' => 'FESX624Fiber+1XG',
            'snFESX624FiberPlus1XGRouter' => 'FESX624Fiber+1XG',
            'snFESX624FiberPlus1XGPrem' => 'FastIron Edge V6 Switch(FES)Fiber 24G + 1 10G-PREM',
            'snFESX624FiberPlus1XGPremSwitch' => 'FESX624Fiber+1XG-PREM',
            'snFESX624FiberPlus1XGPremRouter' => 'FESX624Fiber+1XG-PREM',
            'snFESX624FiberPlus2XG' => 'FastIron Edge V6 Switch(FES)Fiber 24G + 2 10G',
            'snFESX624FiberPlus2XGSwitch' => 'FESX624Fiber+2XG',
            'snFESX624FiberPlus2XGRouter' => 'FESX624Fiber+2XG',
            'snFESX624FiberPlus2XGPrem' => 'FastIron Edge V6 Switch(FES)Fiber 24G + 2 10G-PREM',
            'snFESX624FiberPlus2XGPremSwitch' => 'FESX624Fiber+2XG-PREM',
            'snFESX624FiberPlus2XGPremRouter' => 'FESX624Fiber+2XG-PREM',
            'snFESX648Fiber' => 'FastIron Edge V6 Switch(FES)Fiber 48G',
            'snFESX648FiberSwitch' => 'FESX648Fiber',
            'snFESX648FiberRouter' => 'FESX648Fiber',
            'snFESX648FiberPrem' => 'FastIron Edge V6 Switch(FES)Fiber 48G-PREM',
            'snFESX648FiberPremSwitch' => 'FESX648Fiber-PREM',
            'snFESX648FiberPremRouter' => 'FESX648Fiber-PREM',
            'snFESX648FiberPlus1XG' => 'FastIron Edge V6 Switch(FES)Fiber 48G + 1 10G',
            'snFESX648FiberPlus1XGSwitch' => 'FESX648Fiber+1XG',
            'snFESX648FiberPlus1XGRouter' => 'FESX648Fiber+1XG',
            'snFESX648FiberPlus1XGPrem' => 'FastIron Edge V6 Switch(FES)Fiber 48G + 1 10G-PREM',
            'snFESX648FiberPlus1XGPremSwitch' => 'FESX648Fiber+1XG-PREM',
            'snFESX648FiberPlus1XGPremRouter' => 'FESX648Fiber+1XG-PREM',
            'snFESX648FiberPlus2XG' => 'FastIron Edge V6 Switch(FES)Fiber 48G + 2 10G',
            'snFESX648FiberPlus2XGSwitch' => 'FESX648Fiber+2XG',
            'snFESX648FiberPlus2XGRouter' => 'FESX648+2XG',
            'snFESX648FiberPlus2XGPrem' => 'FastIron Edge V6 Switch(FES)Fiber 48G + 2 10G-PREM',
            'snFESX648FiberPlus2XGPremSwitch' => 'FESX648Fiber+2XG-PREM',
            'snFESX648FiberPlus2XGPremRouter' => 'FESX648Fiber+2XG-PREM',
            'snFESX624P' => 'FastIron Edge V6 Switch(FES) 24G POE',
            'snFWSX424' => 'FWSX24G',
            'snFWSX424Switch' => 'FWSX424',
            'FWSX24GSwitch' => 'FWSX424',
            'snFWSX424Router' => 'FWSX424',
            'snFWSX424Plus1XG' => 'FWSX24G + 1 10G',
            'snFWSX424Plus1XGSwitch' => 'FWSX424+1XG',
            'snFWSX424Plus1XGRouter' => 'FWSX424+1XG',
            'snFWSX424Plus2XG' => 'FWSX24G + 2 10G',
            'snFWSX424Plus2XGSwitch' => 'FWSX424+2XG',
            'snFWSX424Plus2XGRouter' => 'FWSX424+2XG',
            'snFWSX448' => 'FWSX48G',
            'snFWSX448Switch' => 'FWSX448',
            'snFWSX448Router' => 'FWSX448',
            'snFWSX448Plus1XG' => 'FWSX48G + 1 10G',
            'snFWSX448Plus1XGSwitch' => 'FWSX448+1XG',
            'snFWSX448Plus1XGRouter' => 'FWSX448+1XG',
            'snFWSX448Plus2XG' => 'FWSX448G+2XG',
            'snFWSX448Plus2XGSwitch' => 'FWSX448+2XG',
            'snFWSX448Plus2XGRouter' => 'FWSX448+2XG',
            'snFastIronSuperXFamily' => 'FastIron SuperX Family',
            'snFastIronSuperX' => 'FastIron SuperX',
            'snFastIronSuperXSwitch' => 'FastIron SuperX Switch',
            'snFastIronSuperXRouter' => 'FastIron SuperX Router',
            'snFastIronSuperXBaseL3Switch' => 'FastIron SuperX Base L3 Switch',
            'snFastIronSuperXPrem' => 'FastIron SuperX Premium',
            'snFastIronSuperXPremSwitch' => 'FastIron SuperX Premium Switch',
            'snFastIronSuperXPremRouter' => 'FastIron SuperX Premium Router',
            'snFastIronSuperXPremBaseL3Switch' => 'FastIron SuperX Premium Base L3 Switch',
            'snFastIronSuperX800' => 'FastIron SuperX 800 ',
            'snFastIronSuperX800Switch' => 'FastIron SuperX 800 Switch',
            'snFastIronSuperX800Router' => 'FastIron SuperX 800 Router',
            'snFastIronSuperX800BaseL3Switch' => 'FastIron SuperX 800 Base L3 Switch',
            'snFastIronSuperX800Prem' => 'FastIron SuperX 800 Premium',
            'snFastIronSuperX800PremSwitch' => 'FastIron SuperX 800 Premium Switch',
            'snFastIronSuperX800PremRouter' => 'FastIron SuperX 800 Premium Router',
            'snFastIronSuperX800PremBaseL3Switch' => 'FastIron SuperX 800 Premium Base L3 Switch',
            'snFastIronSuperX1600' => 'FastIron SuperX 1600 ',
            'snFastIronSuperX1600Switch' => 'FastIron SuperX 1600 Switch',
            'snFastIronSuperX1600Router' => 'FastIron SuperX 1600 Router',
            'snFastIronSuperX1600BaseL3Switch' => 'FastIron SuperX 1600 Base L3 Switch',
            'snFastIronSuperX1600Prem' => 'FastIron SuperX 1600 Premium',
            'snFastIronSuperX1600PremSwitch' => 'FastIron SuperX 1600 Premium Switch',
            'snFastIronSuperX1600PremRouter' => 'FastIron SuperX 1600 Premium Router',
            'snFastIronSuperX1600PremBaseL3Switch' => 'FastIron SuperX 1600 Premium Base L3 Switch',
            'snFastIronSuperXV6' => 'FastIron SuperX V6 ',
            'snFastIronSuperXV6Switch' => 'FastIron SuperX V6 Switch',
            'snFastIronSuperXV6Router' => 'FastIron SuperX V6 Router',
            'snFastIronSuperXV6BaseL3Switch' => 'FastIron SuperX V6 Base L3 Switch',
            'snFastIronSuperXV6Prem' => 'FastIron SuperX V6 Premium',
            'snFastIronSuperXV6PremSwitch' => 'FastIron SuperX V6 Premium Switch',
            'snFastIronSuperXV6PremRouter' => 'FastIron SuperX V6 Premium Router',
            'snFastIronSuperXV6PremBaseL3Switch' => 'FastIron SuperX V6 Premium Base L3 Switch',
            'snFastIronSuperX800V6' => 'FastIron SuperX 800 V6 ',
            'snFastIronSuperX800V6Switch' => 'FastIron SuperX 800 V6 Switch',
            'snFastIronSuperX800V6Router' => 'FastIron SuperX 800 V6 Router',
            'snFastIronSuperX800V6BaseL3Switch' => 'FastIron SuperX 800 V6 Base L3 Switch',
            'snFastIronSuperX800V6Prem' => 'FastIron SuperX 800 V6 Premium',
            'snFastIronSuperX800V6PremSwitch' => 'FastIron SuperX 800 Premium V6 Switch',
            'snFastIronSuperX800V6PremRouter' => 'FastIron SuperX 800 Premium V6 Router',
            'snFastIronSuperX800V6PremBaseL3Switch' => 'FastIron SuperX 800 Premium V6 Base L3 Switch',
            'snFastIronSuperX1600V6' => 'FastIron SuperX 1600 V6 ',
            'snFastIronSuperX1600V6Switch' => 'FastIron SuperX 1600 V6 Switch',
            'snFastIronSuperX1600V6Router' => 'FastIron SuperX 1600 V6 Router',
            'snFastIronSuperX1600V6BaseL3Switch' => 'FastIron SuperX 1600 V6 Base L3 Switch',
            'snFastIronSuperX1600V6Prem' => 'FastIron SuperX 1600 Premium V6',
            'snFastIronSuperX1600V6PremSwitch' => 'FastIron SuperX 1600 Premium V6 Switch',
            'snFastIronSuperX1600V6PremRouter' => 'FastIron SuperX 1600 Premium V6 Router',
            'snFastIronSuperX1600V6PremBaseL3Switch' => 'FastIron SuperX 1600 Premium V6 Base L3 Switch',
            'snBigIronSuperXFamily' => 'BigIron SuperX Family',
            'snBigIronSuperX' => 'BigIron SuperX',
            'snBigIronSuperXSwitch' => 'BigIron SuperX Switch',
            'snBigIronSuperXRouter' => 'BigIron SuperX Router',
            'snBigIronSuperXBaseL3Switch' => 'BigIron SuperX Base L3 Switch',
            'snTurboIronSuperXFamily' => 'TurboIron SuperX Family',
            'snTurboIronSuperX' => 'TurboIron SuperX',
            'snTurboIronSuperXSwitch' => 'TurboIron SuperX Switch',
            'snTurboIronSuperXRouter' => 'TurboIron SuperX Router',
            'snTurboIronSuperXBaseL3Switch' => 'TurboIron SuperX Base L3 Switch',
            'snTurboIronSuperXPrem' => 'TurboIron SuperX Premium',
            'snTurboIronSuperXPremSwitch' => 'TurboIron SuperX Premium Switch',
            'snTurboIronSuperXPremRouter' => 'TurboIron SuperX Premium Router',
            'snTurboIronSuperXPremBaseL3Switch' => 'TurboIron SuperX Premium Base L3 Switch',
            'snNIIMRRouter' => 'NetIron IMR',
            'snBIRX16Switch' => 'BigIron RX16',
            'snBIRX16Router' => 'BigIron RX16',
            'snBIRX8Switch' => 'BigIron RX8',
            'snBIRX8Router' => 'BigIron RX8',
            'snBIRX4Switch' => 'BigIron RX4',
            'snBIRX4Router' => 'BigIron RX4',
            'snBIRX32Switch' => 'BigIron RX32',
            'snBIRX32Router' => 'BigIron RX32',
            'snNIXMR16000Router' => 'NetIron XMR16000',
            'snNIXMR8000Router' => 'NetIron XMR8000',
            'snNIXMR4000Router' => 'NetIron XMR4000',
            'snNIXMR32000Router' => 'NetIron XMR32000',
            'snSecureIronLS100' => 'SecureIronLS 100',
            'snSecureIronLS100Switch' => 'SecureIronLS 100 Switch',
            'snSecureIronLS100Router' => 'SecureIronLS 100 Router',
            'snSecureIronLS300' => 'SecureIronLS 300',
            'snSecureIronLS300Switch' => 'SecureIronLS 300 Switch',
            'snSecureIronLS300Router' => 'SecureIronLS 300 Router',
            'snSecureIronTM100' => 'SecureIronTM 100',
            'snSecureIronTM100Switch' => 'SecureIronTM 100 Switch',
            'snSecureIronTM100Router' => 'SecureIronTM 100 Router',
            'snSecureIronTM300' => 'SecureIronTM 300',
            'snSecureIronTM300Switch' => 'SecureIronTM 300 Switch',
            'snSecureIronTM300Router' => 'SecureIronTM 300 Router',
            'snNetIronMLX16Router' => 'NetIron MLX-16',
            'snNetIronMLX8Router' => 'NetIron MLX-8',
            'snNetIronMLX4Router' => 'NetIron MLX-4',
            'snNetIronMLX32Router' => 'NetIron MLX-32',
            'snFGS624P' => 'FastIron FGS624P',
            'snFGS624PSwitch' => 'FGS624P',
            'snFGS624PRouter' => 'FGS624P',
            'snFGS624XGP' => 'FastIron FGS624XGP',
            'snFGS624XGPSwitch' => 'FGS624XGP',
            'snFGS624XGPRouter' => 'FGS624XGP',
            'snFGS624PP' => 'FastIron FGS624XGP',
            'snFGS624XGPP' => 'FGS624XGP-POE',
            'snFGS648P' => 'FastIron GS FGS648P',
            'snFGS648PSwitch' => 'FastIron FGS648P',
            'snFGS648PRouter' => 'FastIron FGS648P',
            'snFGS648PP' => 'FastIron FGS648P-POE',
            'snFLS624' => 'FastIron FLS624',
            'snFLS624Switch' => 'FastIron FLS624',
            'snFLS624Router' => 'FastIron FLS624',
            'snFLS648' => 'FastIron FLS648',
            'snFLS648Switch' => 'FastIron FLS648',
            'snFLS648Router' => 'FastIron FLS648',
            'snSI100' => 'ServerIron SI100',
            'snSI100Switch' => 'ServerIron SI100',
            'snSI100Router' => 'ServerIron SI100',
            'snSI350' => 'ServerIron 350 series',
            'snSI350Switch' => 'SI350',
            'snSI350Router' => 'SI350',
            'snSI450' => 'ServerIron 450 series',
            'snSI450Switch' => 'SI450',
            'snSI450Router' => 'SI450',
            'snSI850' => 'ServerIron 850 series',
            'snSI850Switch' => 'SI850',
            'snSI850Router' => 'SI850',
            'snSI350Plus' => 'ServerIron 350 Plus series',
            'snSI350PlusSwitch' => 'SI350 Plus',
            'snSI350PlusRouter' => 'SI350 Plus',
            'snSI450Plus' => 'ServerIron 450 Plus series',
            'snSI450PlusSwitch' => 'SI450 Plus',
            'snSI450PlusRouter' => 'SI450 Plus',
            'snSI850Plus' => 'ServerIron 850 Plus series',
            'snSI850PlusSwitch' => 'SI850 Plus',
            'snSI850PlusRouter' => 'SI850 Plus',
            'snServerIronGTc' => 'ServerIronGT C series',
            'snServerIronGTcSwitch' => 'ServerIronGT C',
            'snServerIronGTcRouter' => 'ServerIronGT C',
            'snServerIronGTe' => 'ServerIronGT E series',
            'snServerIronGTeSwitch' => 'ServerIronGT E',
            'snServerIronGTeRouter' => 'ServerIronGT E',
            'snServerIronGTePlus' => 'ServerIronGT E Plus series',
            'snServerIronGTePlusSwitch' => 'ServerIronGT E Plus',
            'snServerIronGTePlusRouter' => 'ServerIronGT E Plus',
            'snServerIron4G' => 'ServerIron4G series',
            'snServerIron4GSwitch' => 'ServerIron4G',
            'snServerIron4GRouter' => 'ServerIron4G',
            'wirelessAp' => 'wireless access point',
            'wirelessProbe' => 'wireless probe',
            'ironPointMobility' => 'IronPoint Mobility Series',
            'ironPointMC' => 'IronPoint Mobility Controller',
            'dcrs7504Switch' => 'DCRS-7504',
            'dcrs7504Router' => 'DCRS-7504',
            'dcrs7508Switch' => 'DCRS-7508',
            'dcrs7508Router' => 'DCRS-7508',
            'dcrs7515Switch' => 'DCRS-7515',
            'dcrs7515Router' => 'DCRS-7515',
            'snCes2024F' => 'NetIron CES 2024F',
            'snCes2024C' => 'NetIron CES 2024C',
            'snCes2048F' => 'NetIron CES 2048F',
            'snCes2048C' => 'NetIron CES 2048C',
            'snCes2048FX' => 'NetIron CES 2048F + 2x10G',
            'snCes2048CX' => 'NetIron CES 2048C + 2x10G',
            'snCer2024F' => 'NetIron CER 2024F',
            'snCer2024C' => 'NetIron CER 2024C',
            'snCer2048F' => 'NetIron CER 2048F',
            'snCer2048C' => 'NetIron CER 2048C',
            'snCer2048FX' => 'NetIron CER 2048F + 2x10G',
            'snCer2048CX' => 'NetIron CER 2048C + 2x10G',
            'snTI2X24Router' => 'Stackable TurboIron-X24',
            'snBrocadeMLXe4Router' => 'NetIron MLXe-4',
            'snBrocadeMLXe8Router' => 'NetIron MLXe-8',
            'snBrocadeMLXe16Router' => 'NetIron MLXe-16',
            'snBrocadeMLXe32Router' => 'NetIron MLXe-32',
            'snICX643024Switch' => 'Brocade ICX 6430 24-port Switch',
            'snICX643048Switch' => 'Brocade ICX 6430 48-port Switch',
            'snICX645024Switch' => 'Brocade ICX 6450 24-port Switch',
            'snICX645048Switch' => 'Brocade ICX 6450 48-port Switch',
            'snICX661024Switch' => 'Brocade ICX 6610 24-port Switch',
            'snICX661048Switch' => 'Brocade ICX 6610 48-port Switch',
            'snICX665064Switch' => 'Brocade ICX 6650 64-port Switch',
            'snICX725024Switch' => 'Brocade ICX 7250 24-port Switch',
            'snICX725048Switch' => 'Brocade ICX 7250 48-port Switch',
            'snICX745024Switch' => 'Brocade ICX 7450 24-port Switch',
            'snICX745048Switch' => 'Brocade ICX 7450 48-port Switch',
            'snFastIronStackICX6430Switch' => 'Brocade ICX 6430 Switch stack',
            'snFastIronStackICX6450Switch' => 'Brocade ICX 6450 Switch stack',
            'snFastIronStackICX6610Switch' => 'Brocade ICX 6610 Switch stack',
            'snFastIronStackICX7250Switch' => 'Brocade ICX 7250 Switch stack',
            'snFastIronStackICX7450Switch' => 'Brocade ICX 7450 Switch stack',
            'snFastIronStackICX7750Switch' => 'Brocade ICX 7750 Switch stack',
        ];

        $this->getDevice()->hardware = array_str_replace($rewrite_ironware_hardware, $this->getDevice()->hardware);
    }
}
